import React, { createContext, useEffect, useState } from "react";
import Cookies from "universal-cookie";
import axios from 'axios';

const CartContext = createContext(0);

export const CartProvider = ({ children }) => {
    const [cartQuantity, setCartQuantity] = useState(0);

    const updateCartQuantity = async () => {
        try {
            const jwt = new Cookies().get('refresh_token');
            const response = await axios.get('http://localhost:8080/api/cart', {
                headers: {
                    Authorization: `Bearer ${jwt}`
                }
            });
            const cart = response.data.items;
            if (!cart || cart.length === 0) {
                setCartQuantity(0);
            } else {
                let quantity = 0;
                cart.forEach((item) => {
                    quantity += item.quantity;
                });
                setCartQuantity(quantity);
            }
        } catch (error) {
            console.error('Erreur lors de la mise à jour de la quantité du panier :', error);
            setCartQuantity(0);
        }
    };

    useEffect(() => {
        updateCartQuantity();
    }, []);

    return (
        <CartContext.Provider value={{ cartQuantity, updateCartQuantity }}>
            {children}
        </CartContext.Provider>
    );
};

export default CartContext;
