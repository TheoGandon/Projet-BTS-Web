import React from 'react';
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import './css/Navigation.css';

const handleButtonClick = (index) => {
  const redirectionLink = `./src/Produit'${index + 1}`;
  
  window.location.href = redirectionLink;
};

const Navigation = () => {
  function Profile({ index }) {
    const articleNumber = index + 1;
    const price = '110€';
  
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
          src="https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/4d780f51-6061-4096-81fc-a8272635ef4f/chaussure-air-max-97-futura-pour-gcxb95.png"
          alt={`Article ${articleNumber}`}
          style={{ width: '100%', height: '50%'}}
        />
        <div className="overlay-text">
          <div className="label-top-left">{`Article ${articleNumber}`}</div>
          <div className="label-top-right">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <div className="label-bottom-left">{`${price}`}</div>
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
          <h1>Hommes</h1>
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