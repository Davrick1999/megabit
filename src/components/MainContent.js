import React from "react";
import "../App.css";
import logo from "../assets/logos/ic_success.svg";
import Navbar from "../components/navbar/Navbar";
import InputField from "../components/input/InputField";
import SocialIcons from "../components/SocialIcons";

class MainContent extends React.Component {
  constructor(props) {
    super(props);

    this.handler = this.handler.bind(this);
  }

  handler() {
    this.setState({
      isSuccessful: !this.state.isSuccessful,
    });
  }

  state = {
    isSuccessful: true,
  };

  render() {
    const message = this.state.isSuccessful ? (
      <>
        <div className="heading">Subscribe to newsletter</div>
        <p className="sub-heading">
          Subscribe to our newsletter and get 10% discount on pineapple glasses.
        </p>
        <InputField
          placeholder="Type your email address here..."
          handler={this.handler}
        />
        <hr className="hr-normal" />
        <SocialIcons className="social-container" />
      </>
    ) : (
      <>
        <div className="heading">
          <h1 className="success-logo">
            <img src={logo} alt="logo" />
          </h1>
          Thanks for subscribing!
        </div>
        <p className="sub-heading success">
          You have successfully subscribed to our email listing. Check your
          email for the discount code.
        </p>
        <hr className="hr-success" />
        <SocialIcons className="social-container success" />
      </>
    );
    return (
      <>
        <Navbar />
        <div className="container">{message}</div>
      </>
    );
  }
}

export default MainContent;
