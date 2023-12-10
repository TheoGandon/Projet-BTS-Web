import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Main from './Main';
import Login from './Login'
import Panier from './Panier'
import Produit from './Produit'
import Favoris from './Favoris'
import Navigation from './Navigation'

export const Routers = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Login />} />
                <Route path="/home" element={<Main />} />
                <Route path="/panier" element={<Panier />} />
                <Route path="/produit" element={<Produit />} />
                <Route path="/favorit" element={<Favoris />} />
                <Route path="/navigation" element={<Navigation />} />
            </Routes>
        </Router>
    );
};
