import React, { useContext, useState } from "react";
import { Button, Card, CardContent } from "@mui/material";
import ImagesCarousel from "./ImagesCarousel";
import Cookies from "universal-cookie";
import CartContext from "../CartContext";
import axios from 'axios';

export default function DetailsProductCard({ data }) {
    const { updateCartQuantity } = useContext(CartContext);

    const [selectedSize, setSelectedSize] = useState(data.sizes && data.sizes.length > 0 ? data.sizes[0].size_id : null);
    const [quantity, setQuantity] = useState(1);

    const images = data.pictures && data.pictures.length > 0 ? data.pictures.map(picture => picture.picture_link) : [];
    const sizes = data.sizes && data.sizes.length > 0 ? data.sizes : [];

    const handleAddToCart = async () => {
        if (!selectedSize) {
            console.error('Erreur : Aucun taille sélectionnée.');
            return;
        }
        
        try {
            const response = await axios.post('http://localhost:8080/api/cart', {
                article_id: data.id,
                quantity,
                size_id: selectedSize
            }, {
                headers: {
                    Authorization: `Bearer ${new Cookies().get('refresh_token')}`
                }
            });
            console.log('Requête POST réussie :', response.data);
            updateCartQuantity();
        } catch (error) {
            console.error('Erreur lors de la requête POST :', error.response ? error.response.data : error.message);
        }
    };

    return (
        <Card className="w-10/12 md:w-2/3 lg:w-1/2 bg-white rounded-lg border border-gray-200 shadow-md m-10">
            <CardContent className="flex flex-wrap">
                <ImagesCarousel images={images} className="w-full"/>
                <div className="flex flex-col space-y-3 p-5 w-full">
                    <h2 className="text-2xl font-bold">{data.title}</h2>
                    <p className="text-gray-600">{data.selling_price} €</p>
                    <p className="text-gray-600">Couleur : {data.color && data.color.length > 0 ? data.color[0].color_label : "N/A"}</p>
                    <div className="flex flex-wrap space-x-2">
                        {sizes.map((size) => (
                            <button 
                                key={size.size_id}
                                className={`py-2 px-4 rounded ${selectedSize === size.size_id ? 'bg-blue-700 text-white' : 'bg-blue-500 text-white'}`}
                                onClick={() => setSelectedSize(size.id)}
                            >
                                {size.size_label}
                            </button>
                        ))}
                    </div>
                    <p className="text-gray-600">Catégorie : {data.category && data.category.length > 0 ? data.category.map(cat => cat.category_name).join(', ') : "N/A"}</p>
                    <div className="flex space-x-2 items-center">
                        <Button
                            variant="contained"
                            onClick={() => setQuantity(prevQuantity => Math.max(prevQuantity - 1, 1))}
                        >
                            -
                        </Button>
                        <span>{quantity}</span>
                        <Button
                            variant="contained"
                            onClick={() => setQuantity(prevQuantity => prevQuantity + 1)}
                        >
                            +
                        </Button>
                    </div>
                    <Button
                        variant="contained"
                        className='w-full mt-4'
                        onClick={handleAddToCart}
                        disabled={!selectedSize}
                    >
                        Ajouter au panier
                    </Button>
                </div>
            </CardContent>
        </Card>
    );
}
