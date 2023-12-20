import React, { useState, useEffect } from 'react';
import './css/accueil.css';
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import { motion } from 'framer-motion';
import { Flip } from 'react-awesome-reveal';

const Accueil = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Fetch data from the API
    fetch('http://localhost:8080/api/get/articles')
      .then(response => response.json())
      .then(data => setProducts(data))
      .catch(error => console.error('Error fetching product data:', error));
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
        {/* New Arrivals */}
        <div className='arrival'>
          <Flip duration={500}>
            <div className='arrival-text'>
              <h1>New Arrivage</h1>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
              <button>Click me</button>
            </div>
          </Flip>
        </div>

        {/* Brands */}
        <div className='brand'>
          {products.map(productCategory => (
            <div key={productCategory.id} className='nike'>
              <Flip duration={700}>
                <div className='nike-text'>
                  <h1>{productCategory.title}</h1>
                  <p>Lorem Ipsum is simply dummy</p>
                  <button>Discover More</button>
                </div>
              </Flip>
            </div>
          ))}
        </div>

        {/* Products */}
        {products.map(productCategory => (
          <div key={productCategory.id} className='product'>
            <h2>{productCategory.title}</h2>
            <p>{productCategory.description}</p>
            <div className='product-container'>
              {productCategory.products.map(product => (
                <div key={product.id} className='product-card'>
                  <img src={product.pictures[0].picture_link} alt={product.title} />
                  <div className='card-container'>
                    <h3>{product.title}</h3>
                    <p>{`€${product.selling_price}`}</p>
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
        ))}
      </motion.div>
      <Footer />
      <script src='https://unpkg.com/aos@2.3.1/dist/aos.js'></script>
    </div>
  );
};

export default Accueil;
