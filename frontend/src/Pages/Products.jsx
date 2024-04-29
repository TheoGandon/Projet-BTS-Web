import React, {useCallback, useContext, useEffect, useState} from "react"

//Components Import
import Product from "../Components/ProductCard"
import { FormControl, MenuItem, Select, TextField, InputLabel } from "@mui/material";
import JWTContext from "../JWTContext";

const styles = {
    bannerTop:{
        backgroundImage: 'url("/images/products-banner.jpg")',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
    }
}

export default function Products() {
    const {jwt, checkToken} = useContext(JWTContext);
    let [items, setItems] = useState([]);
    let [categories, setCategories] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState(0);
    

    checkToken();

    const fetchAllProducts = useCallback( ()=>{
        fetch("http://localhost:8080/api/articles", {
            headers: {
                Authorization: `Bearer ${jwt}`
            }
        })
            .then((response)=>response.json())
            .then((data)=>{
                setItems(data.map((productData, index) => {
                    if(index < 16){
                        return productData;
                    }
                }).filter(Boolean));
            })
            .catch((error)=>{console.log("IMPOSSIBLE DE RECUPERER LES ITEMS : " + error)});
    }, [])

    
    const fetchAllProductsFromCategory = async (category_id) => {
        return await fetch("http://localhost:8080/api/articles/filter/category/" + category_id)
            .then((response) => response.json())
            .then((data) => {
                const filteredData = data.filter(item => item.category[0].id === category_id);
                setItems(filteredData);
            })
            .catch((error) => { console.log("IMPOSSIBLE DE RECUPERER LES ITEMS : " + error) });
    }

    const fetchAllProductsBySearchQuery = ( async (searchQuery)=>{
        return await fetch("http://localhost:8080/api/articles/" + searchQuery)
            .then((response)=>response.json())
            .then((data)=>{
                let productCounter = 0;
                setItems(data.map((productData)=>{
                    productCounter+=1;
                    if(productCounter <=16){
                        return productData;
                    } else {
                        return null;
                    }
                }))
            })
            .catch((error)=>{console.log("IMPOSSIBLE DE RECUPERER LES ITEMS : " + error)});
    })

    const handleCategoryChange = ((event)=>{
        setSelectedCategory(event.target.value);
        if(event.target.value === 0){
            fetchAllProducts()
        } else {
            fetchAllProductsFromCategory(event.target.value);
        }
    });

    const handleSearchChange = ((event)=>{
        if(event.target.value.toString() === ""){
            fetchAllProducts()
        } else {
            fetchAllProductsBySearchQuery(event.target.value);
        }
    })

    useEffect(() => {
        const fetchAllCategories = () => {
            fetch("http://localhost:8080/api/articles/filter/category/29", {
                headers: {
                    Authorization: `Bearer ${jwt}`
                }
            })
            .then((response) => response.json())
            .then((data) => {
                const categories = data.map((product) => product.category).flat();
                const uniqueCategories = Array.from(new Set(categories.map(category => category.id)))
                    .map(id => {
                        return categories.find(category => category.id === id);
                    });
                setCategories(uniqueCategories);
            })
            .catch((error) => {console.log("IMPOSSIBLE DE RECUPERER LES CATEGORIES : " + error)});
        }
        fetchAllCategories();
        fetchAllProducts();
        
        },[fetchAllProducts])

    return(<div className="">
        <div className="h-36" style={{...styles.bannerTop}}></div>
        <div id="content" className="w-full flex flex-wrap justify-center">
            <div className="w-full bg-gray-300 flex flex-wrap justify-evenly mb-6">
                <div className=" my-4 w-1/3">
                    <FormControl fullWidth>
                        <InputLabel id="category-input-label">Catégories</InputLabel>
                        <Select labelId="category-input-label"
                            id="demo-simple-select"
                            onChange={handleCategoryChange}
                            label="Catégories"
                            value={selectedCategory}>
                            <MenuItem value={0}>Toutes les catégories</MenuItem>
                            {categories && categories.map((category) => (
                            <MenuItem key={category.id} value={category.id}>{category.category_name}</MenuItem>))}
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
                    {items.map((item, index)=>{
                        return(<div key={index} className="flex flex-wrap justify-center">
                            <Product data={item}/>
                        </div>);
                    })}
                </div>
            </div>
        </div>
    </div>)
}