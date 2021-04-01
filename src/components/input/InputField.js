import axios from "axios";
import React from "react";
import "./InputField.css";

class InputField extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      fields: { email: "" },
      errors: {},
      checkBoxChecked: false,
    };
  }

  handleValidation() {
    let fields = this.state.fields;
    let errors = {};
    let isValid = true;
    let checkBoxChecked = this.state.checkBoxChecked;

    //Email
    if (!fields["email"]) {
      isValid = false;
      errors["email"] = "Email address is required";
    } else if (typeof fields["email"] !== "undefined") {
      let lastAtPos = fields["email"].lastIndexOf("@");
      let lastDotPos = fields["email"].lastIndexOf(".");
      let lastThreeChar = fields["email"].slice(fields["email"].length - 3);

      // .co
      if (lastThreeChar === ".co") {
        isValid = false;
        errors["email"] =
          "We are not accepting subscriptions from Colombia emails";
      } else if (
        !(
          lastAtPos < lastDotPos &&
          lastAtPos > 0 &&
          fields["email"].indexOf("@@") == -1 &&
          lastDotPos > 2 &&
          fields["email"].length - lastDotPos > 2
        )
      ) {
        isValid = false;
        errors["email"] = "Please provide a valid e-mail address";
      }
      //Terms and Conditions
      else if (!checkBoxChecked) {
        isValid = false;
        errors["checkBox"] = "You must accept the terms and conditions";
      }
    }

    this.setState({ errors: errors });
    return isValid;
  }

  onFormSubmit(e) {
    e.preventDefault();

    if (this.handleValidation()) {
      let formData = new FormData();
      formData.append("email", this.state.fields["email"]);

      const url = "http://localhost:80/react-php/";

      axios
        .post(url, formData)
        .then((res) => console.log(res))
        .catch((err) => console.log(err));

      {
        this.props.handler();
      }
    }
  }

  handleChange(field, e) {
    let fields = this.state.fields;
    fields[field] = e.target.value;
    this.setState({ fields });
  }

  handleCheckClick = () => {
    this.setState({ checkBoxChecked: !this.state.checkBoxChecked });
  };

  render() {
    return (
      <>
        <form className="add-form" onSubmit={this.onFormSubmit.bind(this)}>
          <div className="form-control">
            <input
              refs="email"
              type="text"
              placeholder={this.props.placeholder}
              name="email"
              onChange={this.handleChange.bind(this, "email")}
              value={this.state.fields["email"]}
            />
            <input type="submit" value="" />
            <div className="error">{this.state.errors["email"]}</div>
            <div className="error">{this.state.errors["checkBox"]}</div>
          </div>
          <label className="check-label">
            <input
              type="checkbox"
              checked={this.state.checkBoxChecked}
              onChange={this.handleCheckClick}
            />
            <span>
              I agree to{" "}
              <a className="label" href="#">
                terms of service
              </a>
            </span>
          </label>
        </form>
      </>
    );
  }
}

export default InputField;
