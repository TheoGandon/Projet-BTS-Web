import { TbMailFilled } from "react-icons/tb";
import { Si1Password } from "react-icons/si";
import { motion } from "framer-motion";
import React, { useCallback } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import "../css/Login.css";

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

function Login(props) {

  const navigate = useNavigate();
  const [email, setEmail] = React.useState('');
  const [password, setPassword] = React.useState(''); 

  const validerFormulaire = useCallback(async () => {
    if(email.includes('@')) {
        await axios.post('http://localhost:8080/api/login_check', {
            email: email,
            password: password
        })
        .then(function (response) {
            console.log(response.status);
            props.setToken(response.data.token);
            if(response.status = 200) navigate('/home');
        })
        .catch((error) => {
            console.error(error);
        })
    }else {
        console.log('Erreur de saisie');
    }
},[email,password,navigate])


const handleChange = (event) => {
    const {name, value} = event.target;
    if(name === 'email') setEmail(value);
    if(name === 'password') setPassword(value);
}

const handleSubmit = (event) => {
    event.preventDefault();
    console.log('submit', email, password);
    validerFormulaire();
}

  return (
    <div className="App">
      <form onSubmit={handleSubmit}>
      <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} transition={{ delay: 0.4 }}>
        <motion.div className="login-main" variants={container} initial="hidden" animate="visible">
          <motion.div className="text" variants={item}>
            Log in
          </motion.div>
          <motion.div className="input" variants={item}>
            <div className="icon">
              <TbMailFilled size={30} />
            </div>
            <input onChange={handleChange} name="email" type="text" placeholder="Email Address" />
          </motion.div>
          <motion.div className="input" variants={item}>
            <div className="icon">
              <Si1Password size={30} />
            </div>
            <input onChange={handleChange} name="password" type="password" placeholder="Password" />
          </motion.div>
          <motion.div whileHover={{ scale: 1.05 }} variants={item}>
            <input className="login-button" type="submit" value="Log in" />
          </motion.div>
        </motion.div>
      </motion.div>
      </form>
    </div>
  );
}

export default Login;
