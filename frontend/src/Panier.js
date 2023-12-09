import React from 'react';
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import Slider from './component/Slider';
import { motion } from 'framer-motion';
import './css/Panier.css'
import Dunk from './Asset/dunk.PNG'


const Panier = () => {
  const cartItems = [
    { id: 1, name: 'Product 1', price: 10, image: Dunk },
    { id: 2, name: 'Product 2', price: 20, image: Dunk },
  ];

  const favoriteShoes = [
    { id: 1, name: 'Favorite Shoe 1', image: Dunk }
  ];

  


  return (
    <div>
      <Navbar />
      <motion.div
        initial={{ opacity: 0, x: '-100%' }}
        animate={{ opacity: 1, x: 0 }}
        exit={{ opacity: 0, x: '-100%' }}
        transition={{ type: 'spring', duration: 1 }}
      >
        <section>
          <h2>Panier</h2>
          <div className="cart-container">
            <div className="cart-items">
              {cartItems.map((item) => (
                <motion.div
                  key={item.id}
                  initial={{ opacity: 0, x: '-100%' }}
                  animate={{ opacity: 1, x: 0 }}
                  exit={{ opacity: 0, x: '-100%' }}
                  transition={{ type: 'spring', duration: 0.5 }}
                >
                  <img src={item.image} alt={item.name} />
                  <p>{item.name}</p>
                  <p>${item.price}</p>
                </motion.div>
              ))}
            </div>
            <div className="cart-summary">
              <h3>Récapitulatif</h3>
              <p>Total: ${cartItems.reduce((acc, item) => acc + item.price, 0)}</p>
              <button>Payer</button>
            </div>
          </div>
        </section>

        <section>
          <h2>Favoris</h2>
          <div className="favorite-shoes">
            {favoriteShoes.map((shoe) => (
              <div key={shoe.id}>
                <img src={shoe.image} alt={shoe.name} />
                <p>{shoe.name}</p>
              </div>
            ))}
          </div>
        </section>

        <section>
          <h2>Suggestions</h2>
          
        </section>
      </motion.div>
      <Slider />
      <Footer />
    </div>
  );
};

export default Panier;
