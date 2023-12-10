// Produit.js
import React, { useState } from 'react';
import { motion } from 'framer-motion';
import './css/Produit.css';
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import Slider from './component/Slider';
import Dunk from './Asset/dunk.PNG';

const Produit = () => {
  const [selectedColor, setSelectedColor] = useState('red');
  const [selectedSize, setSelectedSize] = useState('7');
  const [selectedImage, setSelectedImage] = useState(Dunk);

  const shoeColors = ['red', 'blue', 'green'];
  const shoeSizes = ['38', '38', '38', '38', '38', '38', '38', '38', '38', '38', '38', '38'];

  const handleColorChange = (color) => {
    setSelectedColor(color);
    setSelectedImage(Dunk);
  };

  const handleSizeChange = (size) => {
    setSelectedSize(size);
  };

  const handleAddToCart = () => {
    // Implement logic to add the selected product to the cart
    console.log('Product added to cart:', selectedColor, selectedSize);
  };

  const handleAddToFavorites = () => {
    // Implement logic to add the selected product to favorites
    console.log('Product added to favorites:', selectedColor, selectedSize);
  };

  return (
    <div>
      <Navbar />
      <div className="shoe-product-container">
        <div className="shoe-images">
          <motion.img
            src={selectedImage}
            alt={`Shoe in ${selectedColor}`}
            className="main-image"
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            transition={{ duration: 0.5 }}
          />

          <div className="color-options">
            {shoeColors.map((color) => (
              <motion.img
                key={color}
                src={Dunk}
                alt={`Shoe in ${color}`}
                className={`color-option ${selectedColor === color ? 'selected' : ''}`}
                onClick={() => handleColorChange(color)}
                whileHover={{ scale: 1.1 }}
              />
            ))}
          </div>
        </div>

        <div className="shoe-details">
          <div className="selections">
            <label htmlFor="size">Size:</label>
            <div className="size-selection">
              {shoeSizes.map((size) => (
                <motion.button
                  key={size}
                  onClick={() => handleSizeChange(size)}
                  className={`size-button ${selectedSize === size ? 'selected' : ''}`}
                  whileHover={{ scale: 1.05 }}
                >
                  {size}
                </motion.button>
              ))}
            </div>

            <div className="color-selection">
              <label htmlFor="color">Color:</label>
              <select
                id="color"
                value={selectedColor}
                onChange={(e) => handleColorChange(e.target.value)}
              >
                {shoeColors.map((color) => (
                  <option key={color} value={color}>
                    {color}
                  </option>
                ))}
              </select>
            </div>
          </div>

          <div className="product-details">
            <h2>Shoe Name</h2>
            <p>Description of the shoe goes here.</p>
            <div className="action-buttons">
              <button onClick={handleAddToCart}>Add to Cart</button>
              <button onClick={handleAddToFavorites}>Add to Favorites</button>
            </div>
          </div>
        </div>
      </div>
      <Slider />
      <Footer />
    </div>
  );
};

export default Produit;
