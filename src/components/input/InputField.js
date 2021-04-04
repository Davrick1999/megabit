import axios from "axios";
import React, { useState } from "react";
import "./InputField.css";

function InputField(props) {
  const [emailAddress, setEmailAddress] = useState("");
  const [errors, setErrors] = useState({});
  const [shouldSubmit, setShouldSubmit] = useState(false);
  const [checkBoxChecked, setCheckBoxChecked] = useState(false);

  const handleValidation = () => {
    let _email = emailAddress;
    let _errors = {};
    let _isValid = true;
    let _checkBoxChecked = checkBoxChecked;

    //Email
    if (!_email) {
      _isValid = false;
      _errors["email"] = "Email address is required";
    } else if (typeof _email !== "undefined") {
      let lastAtPos = _email.lastIndexOf("@");
      let lastDotPos = _email.lastIndexOf(".");
      let lastThreeChar = _email.slice(_email.length - 3);

      // .co
      if (lastThreeChar === ".co") {
        _isValid = false;
        _errors["email"] =
          "We are not accepting subscriptions from Colombia emails";
      } else if (
        !(
          lastAtPos < lastDotPos &&
          lastAtPos > 0 &&
          _email.indexOf("@@") === -1 &&
          lastDotPos > 2 &&
          _email.length - lastDotPos > 2
        )
      ) {
        _isValid = false;
        _errors["email"] = "Please provide a valid email address";
      }
      //Terms and Conditions
      else if (!_checkBoxChecked) {
        _isValid = false;
        _errors["checkBox"] = "You must accept the terms and conditions";
      }
    }

    setErrors(_errors);
    setShouldSubmit(true);
    return _isValid;
  };

  const onFormSubmit = (e) => {
    e.preventDefault();

    // To see how the errors are handled from php itself,
    // remove the condition

    if (handleValidation()) {
      let formData = new FormData();
      formData.append("email", emailAddress);

      const url = "http://localhost:80/react-php/post.php";

      axios
        .post(url, formData)
        .then((res) => {
          let errors = {};
          errors["email"] = res.data;
          console.log(errors["email"]);
          if (errors["email"] !== 1) {
            setErrors(errors);
            setShouldSubmit(false);
          } else {
            props.handler();
          }
        })
        .catch((err) => console.log(err));

      if (shouldSubmit) {
        props.handler();
      }
    }
  };

  const handleChange = (e) => {
    let _email = emailAddress;
    _email = e.target.value;
    setEmailAddress(_email);
  };

  const handleCheckClick = () => {
    //this.setState({ checkBoxChecked: !this.state.checkBoxChecked });
    setCheckBoxChecked(!checkBoxChecked);
  };

  return (
    <>
      <form className="add-form" onSubmit={onFormSubmit.bind(this)}>
        <div className="form-control">
          <input
            refs="email"
            type="text"
            placeholder={props.placeholder}
            name="email"
            onChange={handleChange.bind(this)}
            value={emailAddress}
          />
          <input type="submit" value="" />
          <div className="error">{errors["email"]}</div>
          <div className="error">{errors["checkBox"]}</div>
        </div>
        <label className="check-label">
          <input
            type="checkbox"
            checked={checkBoxChecked}
            onChange={handleCheckClick}
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

export default InputField;
