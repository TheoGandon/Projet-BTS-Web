import React, { useEffect, useState } from 'react';
import Grid from '@mui/material/Grid';
import Box from '@mui/material/Box';
import { styled } from '@mui/material/styles';
import '../css/Navigation.css';
import { Link } from 'react-router-dom';


const StyledItem = styled(Box)(({ theme }) => ({
  backgroundColor: theme.palette.mode === 'dark' ? '#1A2027' : '#fff',
  ...theme.typography.body2,
  padding: theme.spacing(1),
  textAlign: 'center',
  color: theme.palette.text.secondary,
}));

const Navigation = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    fetch('http://localhost:8080/api/get/articles')
      .then((response) => response.json())
      .then((data) => setProducts(data))
      .catch((error) => console.error('Error fetching products:', error));
  }, []);

  return (
    <div className='product'>
      <h2>Hommes</h2>
      <div className='product-container'>
        <Grid className='custom-grid' container rowSpacing={1} columnSpacing={{ xs: 1, sm: 2, md: 3 }}>
          {products.map((product) => (
            <Grid item xs={4} key={product.id}>
              <StyledItem className='product-card'>
                <Box>
                  {product.pictures.length > 0 && (
                    <img
                      src={product.pictures[0].picture_link}
                      alt={product.title}
                      className='product-image'
                    />
                  )}
                </Box>
                <div className='card-container'>
                  <h3>{product.title}</h3>
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
              </StyledItem>
            </Grid>
          ))}
        </Grid>
      </div>
    </div>
  );
};

export default Navigation;
