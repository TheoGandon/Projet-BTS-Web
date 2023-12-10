import React from 'react';
import ScrollCarousel from 'scroll-carousel-react';
import Dunk from '../Asset/dunk.PNG'
import '../css/Slider.css'


const Slider = () => {
  return (
      <ScrollCarousel
        autoplaySpeed={0.5}
        speed={1}
        autoplay
      >
        {[1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11].map((item) => (
          <div key={item} className='Slider'>
            <a href='#'>
            <img src={Dunk} alt='Dunk' />²
            </a>
          </div>
        ))}
      </ScrollCarousel>
  );
};

export default Slider;