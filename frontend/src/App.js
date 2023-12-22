import './css/App.css';
import React, {useState} from 'react';
import Header from './component/Header';
import Footer from './component/Footer';
import { BrowserRouter, Route, Routes, Navigate } from 'react-router-dom';
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

  const isAuthenticated = () => {
    console.log(jwtToken!== "")
    return jwtToken !== "";
  };


return (
    <div>
    <BrowserRouter>
      {isAuthenticated() && <Header />}
      <Routes>
      <Route
            path="/"
            element={
              isAuthenticated() ? (
                <Navigate to="/home" />
              ) : (
                <Login token={jwtToken} setToken={setJwtToken} />
              )
            }
          />
        <Route
            path="/panier"
            element={
              isAuthenticated() ? (
                <Panier token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/produit/:articleId"
            element={
              isAuthenticated() ? (
                <Produit token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/favorit"
            element={
              isAuthenticated() ? (
                <Favoris token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/navigation"
            element={
              isAuthenticated() ? (
                <Navigation token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/navigationfemme"
            element={
              isAuthenticated() ? (
                <NavigationFemme token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/navigationenfant"
            element={
              isAuthenticated() ? (
                <NavigationEnfant token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/commande"
            element={
              isAuthenticated() ? (
                <Commande token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/home"
            element={
              isAuthenticated() ? (
                <Accueil token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
        <Route
            path="/contact"
            element={
              isAuthenticated() ? (
                <Contact token={jwtToken} setToken={setJwtToken} />
              ) : (
                <Navigate to="/" />
              )
            }
          />
      </Routes>
      {isAuthenticated() && <Footer />}
    </BrowserRouter>
    </div>
  );
}
export default App;