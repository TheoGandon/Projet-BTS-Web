import React, { useState, useEffect } from 'react';
import { motion } from 'framer-motion';
import '../css/Produit.css';
import Slider from '../component/Slider';

const Produit = () => {
  const [selectedColor, setSelectedColor] = useState('');
  const [selectedSize, setSelectedSize] = useState('');
  const [selectedImage, setSelectedImage] = useState('');
  const [productData, setProductData] = useState({
    id: null,
    title: '',
    description: '',
    selling_price: '',
    pictures: [],
    color: [],
    sizes: [],
  });

  useEffect(() => {
    fetch('http://localhost:8080/api/get/articles/21')
      .then(response => response.json())
      .then(data => {
        setProductData(data);
        setSelectedColor(data.color.length > 0 ? data.color[0].color_label : '');
        setSelectedSize(data.sizes.length > 0 ? data.sizes[0].size_label : '');
        setSelectedImage(data.pictures.length > 0 ? data.pictures[0].picture_link : '');
      })
      .catch(error => console.error('Error fetching product data:', error));
  }, []);

  const handleColorChange = (color) => {
    setSelectedColor(color);
    setSelectedImage(productData.pictures.find(pic => pic.color_label === color)?.picture_link || '');
  };

  const handleSizeChange = (size) => {
    setSelectedSize(size);
  };

  const handleAddToCart = () => {
    console.log('Product added to cart:', selectedColor, selectedSize);
  };

  const handleAddToFavorites = () => {
    console.log('Product added to favorites:', selectedColor, selectedSize);
  };

  return (
    <div>
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
            {productData.color.map((color) => (
              <motion.img
                key={color.id}
                src={color.picture_link}
                alt={`Shoe in ${color.color_label}`}
                className={`color-option ${selectedColor === color.color_label ? 'selected' : ''}`}
                onClick={() => handleColorChange(color.color_label)}
                whileHover={{ scale: 1.1 }}
              />
            ))}
          </div>
        </div>

        <div className="shoe-details">
          <div className="selections">
            <label htmlFor="size"></label>
            <div className="size-selection">
              {productData.sizes.map((size) => (
                <motion.button
                  key={size.id}
                  onClick={() => handleSizeChange(size.size_label)}
                  className={`size-button ${selectedSize === size.size_label ? 'selected' : ''}`}
                  whileHover={{ scale: 1.05 }}
                >
                  {size.size_label}
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
                {productData.color.map((color) => (
                  <option key={color.id} value={color.color_label}>
                    {color.color_label}
                  </option>
                ))}
              </select>
            </div>
          </div>

          <div className="product-details">
            <h2>{productData.title}</h2>
            <p>{productData.description}</p>
            <div className="action-buttons">
              <button className='actionB' onClick={handleAddToCart}>Add to Cart</button>
              <button className='actionB' onClick={handleAddToFavorites}>Add to Favorites</button>
            </div>
          </div>
        </div>
      </div>
      <Slider />
    </div>
  );
};

export default Produit;
