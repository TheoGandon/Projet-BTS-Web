import React from 'react';
import "./css/contact.css";
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import { motion, useAnimation } from "framer-motion";
import { MdOutlineSmartphone } from "react-icons/md";
import { GrMailOption } from "react-icons/gr";

const Contact = () => {
    return (
        <div>
            <Navbar />
            <motion.div
            initial={{ opacity: 0, x: '100%' }}
            animate={{ opacity: 1, x: 0 }}
            exit={{ opacity: 0, w: '100%'}}
            transition={{ type: 'just', duration: 1 }}
            >    
                <div className="main">
                    <h1>Nous Contacter</h1>
                    <div className="contact">
                        <div className="content-contact">
                            <div className="tel">
                                <MdOutlineSmartphone size={150}/>
                                <p>09.87.65.43.87.65</p>
                            </div>
                            <div className="mail">
                                <GrMailOption size={150}/>
                                <p>pepsi.bde@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>



            </motion.div>
            <Footer />
        </div>
    )
}

export default Contact;