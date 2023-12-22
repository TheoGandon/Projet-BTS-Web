import './css/App.css';
import React, {useState} from 'react';
import Header from './component/Header';
import Footer from './component/Footer';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Login from './pages/Login';
import Panier from './pages/Panier';
import Produit from './pages/Produit';
import Favoris from './pages/Favoris';
import Navigation from './pages/Navigation';
import NavigationFemme from './pages/Navigation_Femme';
import NavigationEnfant from './pages/Navigation_Enfant';
import Commande from './pages/Commande';
import Accueil from './pages/Accueil';
import Contact from './pages/Contact';


function App() {
  const [jwtToken, setJwtToken] = useState("");

return (
    <div>
    <BrowserRouter>
      <Header/>
      <Routes>
        <Route path="/" element={<Login token={jwtToken} setToken={setJwtToken} />} />
        <Route path="/panier" element={<Panier token={jwtToken} setToken={setJwtToken} />} />
        <Route path="/produit/:articleId" element={<Produit />} />
        <Route path="/favorit" element={<Favoris token={jwtToken} setToken={setJwtToken} />} />
        <Route path="/navigation" element={<Navigation token={jwtToken} setToken={setJwtToken} />} />
        <Route path="/navigationfemme" element={<NavigationFemme token={jwtToken} setToken={setJwtToken} />} />
        <Route path="/navigationenfant" element={<NavigationEnfant token={jwtToken} setToken={setJwtToken} />} />
        <Route path="/commande" element={<Commande token={jwtToken} setToken={setJwtToken} />} />
        <Route path="/home" element={<Accueil token={jwtToken} setToken={setJwtToken}/>} />
        <Route path="/contact" element={<Contact token={jwtToken} setToken={setJwtToken}/>} />
      </Routes>
      <Footer/>
    </BrowserRouter>
    </div>
  );
}
export default App;