import React, { useEffect, useState } from 'react';
import '../css/Accueil.css';
import { Link } from 'react-router-dom';
import { useNavigate } from 'react-router-dom';
import { jwtDecode } from "jwt-decode";
import axios from 'axios';

function Accueil(props) {
  const navigate = useNavigate();
  const [product, setProducts] = useState([]);
  const [token_data, setTokenData] = useState();

  useEffect(() => {
    const getNewToken = () => {
      //await axios.get('http://localhost:8080/api/token/refresh', { withCredentials: true})
      axios.get('http://localhost:8080/api/token/refresh', { withCredentials: true})
      .then((response) => {
          props.setToken(response.data.token);
      })
      .catch((error)=>{
          console.log(error);
          navigate('/login');
      })
    }


    if(props.token !== "") {
        setTokenData(jwtDecode(props.token));

        if(props.token.exp > Math.floor(Date.now() / 1000)) {
            getNewToken();
        }
    } else {
        try {
            getNewToken();
        } catch (error) {
            console.error(error);
            navigate('/login');
        }
    }
      fetch('http://localhost:8080/api/articles', {headers: {Authorization: `Bearer ${props.token}`}})
        .then((response) => {
          console.log(response);
          console.log(response.data); 
          setProducts(response);
        })
        .catch((error) => console.error('Error fetching products:', error));
    
    }, 
  []);


  return (
    <div className='product'>
      <h2>Hommes</h2>
      <div className='product-container'>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
      </div>
      <h2>Femmes</h2>
      <div className='product-container'>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
      </div>

      <h2>Enfant</h2>
      <div className='product-container'>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
        <div className='card-container'>
          <img src={product.pictures} alt={product.title} className='product-image'/>
          <p>{product.title}</p>
          <p>{`€${parseFloat(product.selling_price).toFixed(2)}`}</p>
          <div className='rating'>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='star'>&#9733;</span>
            <span className='panier'>&#129530;</span>
          </div>
          <Link className='btn-details' to={`/produit/${product.id}`}>Voir détails</Link>
        </div>
        
      </div>
    </div>
    
    
  );
}

export default Accueil;