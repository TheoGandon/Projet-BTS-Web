import React, { useState } from 'react';
import '../css/Favoris.css';

const Favorites = () => {
  const handleButtonClick = (index) => {
    const redirectionLink = `./src/Produit'${index + 1}`;
    window.location.href = redirectionLink;
  };

  function FavoriteItem({ index }) {
    const articleNumber = index + 1;
    const price = '110€';
    const [isHeartClicked, setHeartClicked] = useState(false);
  
    const handleHeartClick = () => {
      setHeartClicked(!isHeartClicked);
    };
  
    return (
      <button
        className="favorite-item"
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
          style={{ width: '100%', height: '50%', objectFit: 'cover' }}
        />
        <div className="overlay-text">
          <div className="label-top-left">{`Article ${articleNumber}`}</div>
          <div className="label-bottom-right">
            <span
              style={{ color: isHeartClicked ? 'white' : 'red' }}
              onClick={handleHeartClick}
            >
              &#10084;
            </span>
          </div>
        </div>
      </button>
    );
  }

  function FavoritesGallery() {
    const numFavoriteItems = 7;

    return (
      <section className="favorites-gallery">
        <div className="gallery-header">
          <h1>Favoris</h1>
        </div>
        <div className="favorite-items">
          {[...Array(numFavoriteItems).keys()].map(index => (
            <FavoriteItem key={index} index={index} />
          ))}
        </div>
      </section>
    );
  }

  return (
    <div>
      <FavoritesGallery />
    </div>
  );
};

export default Favorites;
