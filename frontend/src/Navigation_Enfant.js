import React from 'react';
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import './css/Navigation.css';

const handleButtonClick = (index) => {
    const redirectionLink = `/produit'${index + 1}`;
    
    window.location.href = redirectionLink;
  };
  
  const Navigation = () => {
    function Profile({ index }) {
      const articleNumber = index + 1;
      const randomValue = Math.random() * (200 - 100) + 100;
      const roundedValue = Math.round(randomValue);
      const price = `${roundedValue}€`;
    
      return (
        <button
          className="profile"
          style={{
            width: '30%',
            height: '33%',
            margin: '10px',
            position: 'relative',
            overflow: 'hidden',
            background: 'transparent',
            border: 'none',
            padding: '0',
            cursor: 'pointer',
          }}
          onClick={() => handleButtonClick(index)}
        >
          <img
            src="https://www.cdiscount.com/pdt2/2/3/2/1/700x700/mp62204232/rw/nike-air-max-excee-chaussures-pour-enfant-cd6894-1.jpg"
            alt={`Article ${articleNumber}`}
            style={{ width: '100%', height: '50%'}}
          />
          <div className="overlay-text">
            <div className="label-top-left">{`Article ${articleNumber}`}</div>
            <div className="label-bottom-left">{`${price}`}</div>
            <div className="label-top-right">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
            <div className="label-bottom-right">
              <span style={{ color: 'red' }}>&#10084;</span> <span style={{ color: 'black' }}>&#128722;</span>
            </div>
          </div>
        </button>
      );
    }
  
    function Gallery() {
      const numProfiles = 12;
  
      return (
        <section className="gallery">
          <div className="gallery-header">
            <h1>Femmes</h1>
            <div className="filter-sort">
              <span onClick={() => console.log('Filtres')}>Filtres</span>
              <span onClick={() => console.log('Trier par')} style={{ marginLeft: '10px' }}>Trier par</span>
            </div>
          </div>
          <div className="profiles">
            {[...Array(numProfiles).keys()].map(index => (
              <Profile key={index} index={index} />
            ))}
          </div>
          <button className="arrow-down">
            <span>&#8595;</span>
          </button>
        </section>
      );
    }
    
    return (
      <div>
        <Navbar />
        <Gallery/>
        <Footer />
      </div>
    );
  };
  
  
  export default Navigation;