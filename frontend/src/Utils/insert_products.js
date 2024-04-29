const axios = require('axios');
const faker = require('@faker-js/faker');

let categories = [];
let old_products = [];

const getCategories = async () => {
    await fetch('https://api.escuelajs.co/api/v1/categories?limit=10')
        .then((response) => response.json())
        .then((data) => {
            categories = data;
        })
        .catch((error) => {
            console.error(error);
        });
};

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


const insertProducts = async () => {
    const image_dimensions = Math.floor(Math.random() * (2000 - 400) + 400);
    let json_data = {
        "title": faker.faker.commerce.productName(),
        "price": faker.faker.commerce.price(),
        "description": faker.faker.commerce.productDescription(),
        "categoryId": categories[Math.floor(Math.random()*categories.length)],
        "images": ["https://picsum.photos/" + image_dimensions + "/" + image_dimensions + "/", "https://picsum.photos/" + image_dimensions + "/" + image_dimensions]
    };
    await axios.post('https://api.escuelajs.co/api/v1/products', json_data)
        .then(() => console.log("Product inserted"))
        .catch((error) => console.log("Error"));
};



getCategories()
    .then(() => {
        categories = categories.map((category) => category.id)
    })
    .then(()=> {
        for (let i = 0; i < 32; i++) {
            insertProducts();
        }
    });
