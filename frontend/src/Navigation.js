import React, { useState, useEffect } from 'react';
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import './css/Navigation.css';

const Navigation = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Fetch data from the API
    fetch('http://localhost:8080/api/get/articles')
      .then(response => response.json())
      .then(data => setProducts(data))
      .catch(error => console.error('Error fetching data:', error));
  }, []);

  const handleButtonClick = (index) => {
    const redirectionLink = `/produit/${index + 1}`;
    window.location.href = redirectionLink;
  };

  const renderProduct = (product, index) => {
    const { id, title, selling_price, pictures } = product;
    const price = `${selling_price}€`;

    const imageSrc = pictures && pictures.length > 0 ? pictures[0].picture_link : '';

    return (
      <div key={id} className="profile">
        <button className="profile-button" onClick={() => handleButtonClick(index)}>
        <div className="overlay-text">
        {imageSrc && <img src={imageSrc} alt={`Article ${id}`} />}
          <div className="label-top-left">{`Article ${title}`}</div>
          <div className="label-top-right">{`${price}`}</div>
          <span style={{ color: 'red' }}>&#10084;</span> <span style={{ color: 'black' }}>&#128722;</span>
        </div>
        
        </button>
      </div>
    );
  };

  return (
    <div>
      <Navbar />
      <section className="gallery">
        <div className="gallery-header">
          <h1>Hommes</h1>
          <div className="filter-sort">
            <span onClick={() => console.log('Filtres')}>Filtres</span>
            <span onClick={() => console.log('Trier par')} style={{ marginLeft: '10px' }}>Trier par</span>
          </div>
        </div>
        <div className="profiles">
          {products.map((product, index) => renderProduct(product, index))}
        </div>
        <button className="arrow-down">
          <span>&#8595;</span>
        </button>
      </section>
      <Footer />
    </div>
  );
};

export default Navigation;
