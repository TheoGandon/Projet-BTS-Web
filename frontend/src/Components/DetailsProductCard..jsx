import React, {useContext} from "react";
import {Button, Card, CardContent} from "@mui/material";
import ImagesCarousel from "./ImagesCarousel";
import Cookies from "universal-cookie";
import CartContext from "../CartContext";


export default function DetailsProductCard(data) {
    const {updateCartQuantity} = useContext(CartContext);

    const images = data.data.pictures && data.data.pictures.length > 0 ? data.data.pictures.map(picture => picture.picture_link) : [];
    const size = data.data.sizes && data.data.sizes.length > 0 ? data.data.sizes.map(size => size.size_label) : [];

    const handleAddToCart = () => {
        const cookies = new Cookies();
        if(cookies.get('cart') === undefined) {
            cookies.set('cart',[{id: data.data.id, title: data.data.title, quantity: 1, price: data.data.selling_price}], {path: '/'})
        } else {
            let cart = cookies.get('cart');
            let index = cart.findIndex((item) => item.id === data.data.id);
            if(index === -1) {
                cart.push({id: data.data.id, title: data.data.title, quantity: 1, price: data.data.selling_price});
            } else {
                cart[index].quantity += 1;
                cart[index].selling_price += data.data.selling_price;
            }
            cookies.set('cart', cart, {path: '/'});
        }
        updateCartQuantity();
    };

    return (
        <Card className="w-10/12 md:w-2/3 lg:w-1/2 bg-white rounded-lg border border-gray-200 shadow-md m-10">
            <CardContent className="flex flex-wrap">
                <ImagesCarousel images={images} className="w-full"/>
                <div className="flex flex-col space-y-3 p-5 w-full">
                    <h2 className="text-2xl font-bold">{data.data.title}</h2>
                    <p className="text-gray-600">{data.data.selling_price} €</p>
                    <p className="text-gray-600">Couleur : {data.data.color && data.data.color.length > 0 ? data.data.color[0].color_label : "N/A"}</p>
                    <div className="flex flex-wrap space-x-2">
                        {size.map((s, index) => (<button key={index} className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{s}</button>))}</div>
                    <p className="text-gray-600">Catégorie : {data.data.category && data.data.category.length > 0 ? data.data.category.map(cat => cat.category_name).join(', ') : "N/A"}</p>
                    <Button
                        variant="contained"
                        className='w-full'
                        onClick={handleAddToCart}>
                        Ajouter au panier
                    </Button>
                </div>
            </CardContent>
        </Card>
    )
}