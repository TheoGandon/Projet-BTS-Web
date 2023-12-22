import React from "react";
import { motion } from "framer-motion";
import { MdOutlineFavorite } from "react-icons/md";
import { CiShoppingCart } from "react-icons/ci";
import Logo from "../Asset/SneakHubLogo.PNG";
import "../css/Navbar.css";
import "../css/App.css"; 
import { useNavigate } from "react-router-dom";


const container = {
  hidden: { opacity: 1, scale: 0 },
  visible: {
    opacity: 1,
    scale: 1,
    transition: {
      delayChildren: 0.3,
      staggerChildren: 0.2,
    },
  },
};

const item = {
  hidden: { y: 20, opacity: 0 },
  visible: {
    y: 0,
    opacity: 1,
  },
};

const Navbar = () => {
  const navigate = useNavigate();

  function navig() {
    navigate("/contact")
  }

  return (
    <motion.nav className="nav-main" variants={container} initial="hidden" animate="visible">
      <a onClick={navigate("/")}>
        <img className="logo" alt="logo" src={Logo} />
      </a>
      <div className="link-nav">
        <motion.div variants={item} whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }}>
        <a onClick={navigate("/home")}>Home</a>
        </motion.div>
        <motion.div variants={item} whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }}>
        <a onClick={navig}>Product</a>
        </motion.div>
        <motion.div variants={item} whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }}>
        <a onClick={navigate("/contact")}>Contact</a>
        </motion.div>
      </div>
      <div className="logo-nav-bar">
        <a onClick={navigate("/favorit")}><MdOutlineFavorite className="logo-nav"size={35}/></a>
        <a onClick={navigate("/panier")}><CiShoppingCart className="logo-nav" size={35}/></a>
      </div>
    </motion.nav>
  );
};

export default Navbar;