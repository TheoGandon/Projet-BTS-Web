import { TbMailFilled } from "react-icons/tb";
import { Si1Password } from "react-icons/si";
import { motion } from "framer-motion";
import "./css/Login.css";

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

function Login() {
  return (
    <div className="App">
      <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 0.4 }}>
        <motion.div className="login-main" variants={container} initial="hidden" animate="visible">
          <motion.div className="text" variants={item}>
            Log in
          </motion.div>
          <motion.div className="input" variants={item}>
            <div className="icon">
              <TbMailFilled size={30} />
            </div>
            <input type="text" placeholder="Email Address" />
          </motion.div>
          <motion.div className="input" variants={item}>
            <div className="icon">
              <Si1Password size={30} />
            </div>
            <input type="password" placeholder="Password" />
          </motion.div>
          <motion.button className="login-button" whileHover={{ scale: 1.05 }} variants={item}>
            <a href="/home">
            Log in
            </a>
          </motion.button>
        </motion.div>
      </motion.div>
    </div>
  );
}

export default Login;
