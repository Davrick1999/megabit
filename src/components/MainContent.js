import React from "react";
import "../App.css";
import Navbar from "../components/navbar/Navbar";
import InputField from "../components/input/InputField";
import SocialIcons from "../components/SocialIcons";

function MainContent() {
  return (
    <>
      <Navbar />
      <div className="container">
        <div className="heading">Subscribe to newsletter</div>
        <p className="sub-heading">
          Subscribe to our newsletter and get 10% discount on pineapple glasses.
        </p>
        <InputField placeholder="Type your email address here..." />

        <hr />
        <SocialIcons />
      </div>
    </>
  );
}

export default MainContent;
