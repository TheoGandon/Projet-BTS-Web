import React, { useCallback, useContext, useEffect, useState } from "react";
import Product from "../Components/ProductCard";
import { FormControl, MenuItem, Select, TextField, InputLabel } from "@mui/material";
import JWTContext from "../JWTContext";

const styles = {
    bannerTop: {
        backgroundImage: 'url("/images/products-banner.jpg")',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
    }
};

export default function Products() {
    const { jwt, checkToken } = useContext(JWTContext);
    let [items, setItems] = useState([]);
    let [categories, setCategories] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState(0);

    checkToken();

    const fetchAllProducts = useCallback(() => {
        fetch("http://localhost:8080/api/articles", {
            headers: {
                Authorization: `Bearer ${jwt}`
            }
        })
            .then((response) => response.json())
            .then((data) => {
                setItems(data.slice(0, 16));
            })
            .catch((error) => { console.log("IMPOSSIBLE DE RECUPERER LES ITEMS : " + error) });
    }, [jwt]);

    const fetchAllProductsFromCategory = useCallback(async () => {
        return await fetch("http://localhost:8080/api/categories", {
            headers: {
                Authorization: `Bearer ${jwt}`
            }
        })
        .then((response) => response.json())
        .then((categories) => {
            return Promise.all(categories.map(category => 
                fetch(`http://localhost:8080/api/articles/${category.id}`, {
                    headers: {
                        Authorization: `Bearer ${jwt}`
                    }
                })
                .then(response => response.json())
            ));
        })
        .then((articlesArrays) => {
            const allArticles = [].concat(...articlesArrays);
            setItems(allArticles);
        })
        .catch((error) => { console.log("IMPOSSIBLE DE RECUPERER LES ARTICLES : " + error) });
    }, [jwt]);

    const fetchAllProductsBySearchQuery = async (searchQuery) => {
        return await fetch("http://localhost:8080/api/articles", {
            headers: {
                Authorization: `Bearer ${jwt}`
            }
        })
        .then((response) => response.json())
        .then((data) => {
            const filteredData = data.filter(article => 
                article.title.toLowerCase().includes(searchQuery.toLowerCase())
            );
            setItems(filteredData.slice(0, 16));
        })
        .catch((error) => { console.log("IMPOSSIBLE DE RECUPERER LES ITEMS : " + error) });
    };

    const handleCategoryChange = useCallback((event) => {
        const value = event.target.value;
        setSelectedCategory(value);
        setItems([]);
        if (value === 0) {
            fetchAllProducts();
        } else {
            fetchAllProductsFromCategory(value.toString());
        }
    }, [fetchAllProducts, fetchAllProductsFromCategory]);

    const handleSearchChange = useCallback((event) => {
        const value = event.target.value;
        if (value === "") {
            fetchAllProducts();
        } else {
            fetchAllProductsBySearchQuery(value);
        }
    }, [fetchAllProducts, fetchAllProductsBySearchQuery]);

    useEffect(() => {
        const fetchAllCategories = () => {
            fetch("http://localhost:8080/api/categories", {
                headers: {
                    Authorization: `Bearer ${jwt}`
                }
            })
            .then((response) => response.json())
            .then((data) => {
                setCategories(data);
            })
            .catch((error) => { console.log("IMPOSSIBLE DE RECUPERER LES CATEGORIES : " + error) });
        };
        fetchAllCategories();
        fetchAllProducts();
    }, [fetchAllProducts, jwt]);

    return (
        <div className="">
            <div className="h-36" style={{ ...styles.bannerTop }}></div>
            <div id="content" className="w-full flex flex-wrap justify-center">
                <div className="w-full bg-gray-300 flex flex-wrap justify-evenly mb-6">
                    <div className="my-4 w-1/3">
                        <FormControl fullWidth>
                            <InputLabel id="category-input-label">Catégories</InputLabel>
                            <Select
                                labelId="category-input-label"
                                id="demo-simple-select"
                                onChange={handleCategoryChange}
                                label="Catégories"
                                value={selectedCategory}
                            >
                                <MenuItem value={0}>Toutes les catégories</MenuItem>
                                {Array.isArray(categories) && categories.map((category) => (
                                    <MenuItem key={category.id} value={category.id}>{category.name}</MenuItem>
                                ))}
                            </Select>
                        </FormControl>
                    </div>
                    <div className="my-4 w-1/3">
                        <TextField
                            id="outlined-search"
                            label="Rechercher"
                            type="search"
                            onChange={handleSearchChange}
                            fullWidth
                        />
                    </div>
                </div>
                <div className="container">
                    <div id="products-container" className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4">
                        {items.map((item, index) => (
                            <div key={index} className="flex flex-wrap justify-center">
                                <Product data={item} />
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </div>
    );
}
