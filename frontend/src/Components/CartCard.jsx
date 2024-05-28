import React, { useContext, useEffect, useState } from "react";
import Cookies from "universal-cookie";
import { Card, CardContent, Button } from "@mui/material";
import { Link } from "react-router-dom";
import axios from 'axios';
import cartContext from "../CartContext";

export default function CartCard() {
    const [cartContent, setCartContent] = useState([]);
    const [cartTotals, setCartTotals] = useState({ total: 0, items: 0 });
    const { updateCartQuantity } = useContext(cartContext);

    const updateCartTotals = () => {
        if (cartContent && cartContent.length > 0) {
            let total = 0;
            let items = 0;
            cartContent.forEach((item) => {
                total += parseFloat(item.selling_price) * item.quantity;
                items += item.quantity;
            });
            setCartTotals({ total: total, items: items });
        }
    };

    const handleDeleteFromCart = async (cartId) => {
        try {
            const jwt = new Cookies().get('refresh_token');
            await axios.delete(`http://localhost:8080/api/cart/${cartId}`, {
                headers: {
                    Authorization: `Bearer ${jwt}`
                }
            });
            setCartContent(prevCartContent => prevCartContent.filter(item => item.cart_id !== cartId));
            updateCartQuantity();
            updateCartTotals();
        } catch (error) {
            console.error('Erreur lors de la suppression de l\'article du panier :', error);
        }
    };

    useEffect(() => {
        const fetchCartData = async () => {
            try {
                const jwt = new Cookies().get('refresh_token');
                const response = await axios.get('http://localhost:8080/api/cart', {
                    headers: {
                        Authorization: `Bearer ${jwt}`
                    }
                });
                setCartContent(response.data.items);
                setCartTotals({ total: response.data.total_price, items: response.data.items.length });
            } catch (error) {
                console.error('Erreur lors de la récupération du panier :', error);
            }
        };

        fetchCartData();
    }, []);

    useEffect(() => {
        updateCartTotals();
    }, [cartContent]);

    return (
        <Card className="w-5/6 md:w-2/3 lg:w-1/2">
            <CardContent>
                {cartContent.length === 0 ? (
                    <p className="w-full text-center">Votre panier est vide</p>
                ) : (
                    <div>
                        <h2 className="text-2xl font-bold mb-4">Votre Panier :</h2>
                        <table className="w-full table-auto text-left">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Qty.</th>
                                    <th>Price</th>
                                    <th>Del.</th>
                                </tr>
                            </thead>
                            <tbody>
                                {cartContent.map((item, index) => (
                                    <tr key={index}>
                                        <td className="italic underline hover:font-semibold">
                                            <Link to={"/p/" + item.article_id}>{item.article_title}</Link>
                                        </td>
                                        <td>{item.quantity}</td>
                                        <td>{item.selling_price} €</td>
                                        <td>
                                            <Button onClick={() => handleDeleteFromCart(item.cart_id)} className="text-red-600 hover:underline">
                                                Del
                                            </Button>
                                        </td>
                                    </tr>
                                ))}
                                <tr className="font-bold">
                                    <td>Total</td>
                                    <td>{cartTotals.items}</td>
                                    <td>{cartTotals.total} €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                )}
            </CardContent>
        </Card>
    );
}
