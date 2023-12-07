import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Main from './Main';
import Login from './Login'
import Panier from './Panier'

export const Routers = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Login />} />
                <Route path="/home" element={<Main />} />
                <Route path="/panier" element={<Panier />} />
            </Routes>
        </Router>
    );
};
