const axios = require('axios');

let old_products = []

const getProducts = async () => {
    await fetch('https://api.escuelajs.co/api/v1/products')
        .then((response) => response.json())
        .then((data) => {
            old_products = data;
        })
        .catch((error) => {
            console.error(error);
        });
};

const deleteProducts = async (pid) => {
    await axios.delete('https://api.escuelajs.co/api/v1/products/' + pid)
        .then(() => console.log("Product deleted"))
        .catch((error) => console.log(error));
};

getProducts()
.then(()=> {
    for(let i=0; i < old_products.length; i++){
        deleteProducts(old_products[i].id);
    }
});