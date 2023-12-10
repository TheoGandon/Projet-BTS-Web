import React from "react";
import { motion } from "framer-motion";
import "../css/Footer.css";
import "../css/App.css";
import Logo from "../Asset/SneakHubLogo.PNG"

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

const Footer = () => {
  return (
    <footer>
    <motion.footer
      style={{
        background: '#1E1E1E',
        padding: '2%',
        color: '#FFFFFF',
        display: 'flex',
        marginTop: '10%'
      }}
      variants={container}
      initial="hidden"
      animate="visible"
    >
      <motion.div variants={item} style={{flex: 1}} className="footer-content">
        <img src={Logo} alt="Logo" style={{ maxWidth: '30%', height: 'auto' }} />
        <p>Address : rue Alfonse Colas</p>
        <p>E-mail : pepsi.bde@gmail.com</p>
        <p>Phone : +33 3 56 78 61 10</p>
      </motion.div>
      <motion.div variants={item} style={{ flex: 1 }} className="footer-content">
        <h3>Shopping and Categories</h3>
        <a href="#">Men's Shopping</a>
        <a href="#">Women's Shopping</a>
        <a href="#">Kid's Shopping</a>
      </motion.div>
      <motion.div variants={item} style={{ flex: 1 }} className="footer-content">
        {/* Contenu de la troisième colonne ici */}
        <h3>Useful Links</h3>
        <a href="#">Contact Us</a>
      </motion.div>
    </motion.footer>
    <motion.div variants={item} style={{ 
      display: "inline-block",
      color: '#FFFFFF',
      backgroundColor: '#000000',
      width: '100%',
      padding: '2%',
      fontSize: '14px',
      textAlign: 'center'
  }}>
        <a href="#">Copyright @ 2023</a>
      </motion.div>
    </footer>
  );
};


export default Footer;
