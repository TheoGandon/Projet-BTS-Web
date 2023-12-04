import React from "react";
import { motion } from "framer-motion";
import "../css/Footer.css";
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

const Footer = () => {
  return (
    <div className="footer">
        
    </div>
  );
};

export default Footer;
