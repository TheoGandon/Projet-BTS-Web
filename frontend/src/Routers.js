import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Main from './Main';
import Login from './Login'
import Panier from './Panier'
import Produit from './Produit'
import Favoris from './Favoris'
import Navigation from './Navigation'
import Commande from './Commande';
import Accueil from './Accueil';
import Contact from './contact';



export const Routers = () => {
    return (
        <Router>
            <Routes>
                <Route path="/" element={<Login />} />
                <Route path="/home" element={<Main />} />
                <Route path="/panier" element={<Panier />} />
                <Route path="/produit'1" element={<Produit />} />
                <Route path="/favorit" element={<Favoris />} />
                <Route path="/navigation" element={<Navigation />} />
                <Route path="/commande" element={<Commande />} />
                <Route path="/Accueil" element={<Accueil/>} />
                <Route path="/contact" element={<Contact/>} />
            </Routes>
        </Router>
    );
};
