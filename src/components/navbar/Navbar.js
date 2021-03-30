import React from "react";
import "./Navbar.css";
import logo from "../../assets/logos/logo_pineapple.svg";
function Navbar() {
  const menuItems = [
    {
      title: "About",
      url: "#",
      className: "nav-links",
    },
    {
      title: "How it works",
      url: "#",
      className: "nav-links",
    },
    {
      title: "Contact",
      url: "#",
      className: "nav-links",
    },
  ];

  return (
    <nav className="NavbarItems">
      <h1 className="navbar-logo">
        <img src={logo} alt="logo" />
      </h1>
      <ul className="nav-menu">
        {menuItems.map((item, index) => {
          return (
            <li key={index}>
              <a className={item.className} href={item.url}>
                {item.title}
              </a>
            </li>
          );
        })}
      </ul>
    </nav>
  );
}

export default Navbar;
