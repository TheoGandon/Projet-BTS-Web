import React, { useEffect, useState } from 'react';
import './css/accueil.css';
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import { motion } from 'framer-motion';
import { Flip } from 'react-awesome-reveal';

const Accueil = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    fetch('http://localhost:8080/api/get/articles')
      .then((response) => response.json())
      .then((data) => setProducts(data))
      .catch((error) => console.error('Error fetching products:', error));
  }, []);

  return (
    <div className='box'>
      <Navbar />
      <motion.div
        initial={{ opacity: 0, x: '100%' }}
        animate={{ opacity: 1, x: 0 }}
        exit={{ opacity: 0, w: '100%' }}
        transition={{ type: 'just', duration: 1 }}
      >
        <div className='product'>
          <h2>Hommes</h2>
          <div className='product-container'>
            {products.map((product) => (
              <div key={product.id} className='product-card'>
                {product.pictures.length > 0 && (
                  <img src={product.pictures[0].picture_link} alt={product.title} />
                )}
                <div className='card-container'>
                  <h3>{product.title}</h3>
                  <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
                  <div className='rating'>
                    <span className='star'>&#9733;</span>
                    <span className='star'>&#9733;</span>
                    <span className='star'>&#9733;</span>
                    <span className='star'>&#9733;</span>
                    <span className='star'>&#9733;</span>
                    <span className='panier' href='<panier/>'>&#129530;</span>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </motion.div>
      <Footer />
    </div>
  );
};

export default Accueil;
