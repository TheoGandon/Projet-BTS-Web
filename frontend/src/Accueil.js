import React from 'react';
import "./css/accueil.css";
import Navbar from './component/Navbar';
import Footer from './component/Footer';
import Dunk from "./Asset/téléchargement.jpg";
import { motion, useAnimation } from "framer-motion";
import { Flip } from "react-awesome-reveal";


const Accueil = () => {
  return (
    <div className='box'>
        <Navbar />
        <motion.div
            initial={{ opacity: 0, x: '100%' }}
            animate={{ opacity: 1, x: 0 }}
            exit={{ opacity: 0, w: '100%'}}
            transition={{ type: 'just', duration: 1 }}
        >    
            <div className='maine'>
                    <div className='arrival'>
                        <Flip duration={500}>
                        <div className='arrival-text'>
                            <h1> New Arrivage</h1>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            <button>Click me</button>
                        </div>
                        </Flip>
                    </div>

                <div className='brand'>
                    <div className='nike' >
                        <Flip duration={700}>
                        <div className='nike-text'>
                            <h1>Nike</h1>
                            <p>Lorem Ipsum is simply dummy</p>
                            <button>Discover More</button>
                        </div>
                        </Flip>
                    </div>
                    <div className='nike'>
                        <Flip duration={700}>
                        <div className='nike-text'>
                            <h1>New Balance</h1>
                            <p>Lorem Ipsum is simply dummy</p>
                            <button>Discover More</button>
                        </div>
                        </Flip>
                    </div>
                    <div className='nike'>
                        <Flip duration={700}>
                        <div className='nike-text'>
                            <h1>Geox</h1>
                            <p>Lorem Ipsum is simply dummy</p>
                            <button>Discover More</button>
                        </div>
                        </Flip>
                    </div>
                    <div className='nike'>
                        <Flip duration={700}>
                        <div className='nike-text'>
                            <h1>Adidas</h1>
                            <p>Lorem Ipsum is simply dummy</p>
                            <button>Discover More</button>
                        </div>
                        </Flip>
                    </div>
                </div>
            </div>

            <div className='product'>
                <h2>Hommes</h2>
                <p>lorem ipsum is simplu dummy test of the printingand typesetting industry</p>
                <div className="product-container">
                    <div className="product-card">
                        <img src={Dunk} />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk} />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div className='product'>
                <h2>Femmes</h2>
                <p>lorem ipsum is simplu dummy test of the printingand typesetting industry</p>
                <div className="product-container">
                    <div className="product-card">
                        <img src={Dunk} />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk} />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div className='product'>
                <h2>Enfants</h2>
                <p>lorem ipsum is simplu dummy test of the printingand typesetting industry</p>
                <div className="product-container">
                    <div className="product-card">
                        <img src={Dunk} />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk} />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>
                    </div>
                    <div className="product-card">
                        <img src={Dunk}  />
                        <div className='card-container'>
                            <h3>Nike dunk low</h3>
                            <p>€120.00</p>
                            <div className="rating">
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="star">&#9733;</span>
                                <span className="panier" href='<panier/>'>&#129530;</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </motion.div>
        <Footer />
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    </div>
  );
}


export default Accueil;
