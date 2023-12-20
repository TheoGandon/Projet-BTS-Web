import './css/App.css';
import React from 'react';
import Header from './component/Header';
import Footer from './component/Footer';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Login from './pages/Login';
import Panier from './pages/Panier';
import Produit from './pages/Produit';
import Favoris from './pages/Favoris';
import Navigation from './pages/Navigation';
import Navigation_Femme from './pages/Navigation_Femme';
import Navigation_Enfant from './pages/Navigation_Enfant';
import Commande from './pages/Commande';
import Accueil from './pages/Accueil';
import Contact from './pages/Contact';


function App() {
return (
    <div>
    <BrowserRouter>
      <Header/>
      <Routes>
        <Route path="/" element={<Login />} />
        <Route path="/panier" element={<Panier />} />
        <Route path="/produit'1" element={<Produit />} /> 
        <Route path="/favorit" element={<Favoris />} />
        <Route path="/navigation" element={<Navigation />} />
        <Route path="/navigationfemme" element={<Navigation_Femme />} />
        <Route path="/navigationenfant" element={<Navigation_Enfant />} />
        <Route path="/commande" element={<Commande />} />
        <Route path="/home" element={<Accueil/>} />
        <Route path="/contact" element={<Contact/>} />
      </Routes>
      <Footer/>
    </BrowserRouter>
    </div>
  );
}
export default App;