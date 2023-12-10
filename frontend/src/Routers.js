import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Main from './Main';
import Login from './Login'
import Panier from './Panier'
import Accueil from './Accueil';
import Contact from './contact';

export const Routers = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Login />} />
                <Route path="/home" element={<Main />} />
                <Route path="/panier" element={<Panier />} />
                <Route path="/accueil" element={<Accueil />} />
                <Route path="/contact" element={<Contact/>} />
            </Routes>
        </Router>
    );
};
