import React from "react";
import { motion } from "framer-motion";
import { MdOutlineFavorite } from "react-icons/md";
import { CiShoppingCart } from "react-icons/ci";
import Logo from "../Asset/SneakHubLogo.PNG";
import "../css/Navbar.css";
import "../css/App.css"; 

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
  return (
    <motion.nav className="nav-main" variants={container} initial="hidden" animate="visible">
      <a href="/">
        <img className="logo" alt="logo" src={Logo} />
      </a>
      <div className="link-nav">
        <motion.div variants={item} whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }}>
        <a href="/accueil">Home</a>
        </motion.div>
        <motion.div variants={item} whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }}>
        <a href="/produit">Product</a>
        </motion.div>
        <motion.div variants={item} whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }}>
        <a href="/Pricing">Pricing</a>
        </motion.div>
        <motion.div variants={item} whileHover={{ scale: 1.1 }} whileTap={{ scale: 0.9 }}>
        <a href="/contact">Contact</a>
        </motion.div>
      </div>
      <input className="find-bar" type="search" placeholder="Search"/>
      <a href="/favorit"><MdOutlineFavorite className="logo-nav"size={35}/></a>
      <a href="/panier"><CiShoppingCart className="logo-nav" size={35}/></a>
    </motion.nav>
  );
};

export default Navbar;
