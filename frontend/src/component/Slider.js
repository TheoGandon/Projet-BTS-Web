import React, { useEffect, useState } from 'react';
import ScrollCarousel from 'scroll-carousel-react';
import '../css/Slider.css';
import { Link } from 'react-router-dom';

const Slider = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    fetch('http://localhost:8080/api/get/articles')
      .then((response) => response.json())
      .then((data) => setProducts(data))
      .catch((error) => console.error('Error fetching products:', error));
  }, []);

  if (products.length === 0) {
    return <p>Loading...</p>;
  }

  return (
    <ScrollCarousel autoplaySpeed={0.5} speed={1} autoplay>
      {products.map((product) => (
        <div key={product.id} className='Slider'>
            {product.pictures.length > 0 && (
              <img src={product.pictures[0].picture_link} alt={product.title} />
            )}
            <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
      ))}
    </ScrollCarousel>
  );
};

export default Slider;
