import React, {createContext, useEffect, useState} from "react";
import Cookies from "universal-cookie";

const CartContext = createContext(0);

export const CartProvider = ({ children }) => {
    const [cartQuantity, setCartQuantity] = useState(0);

    const updateCartQuantity = () => {
        const cookies = new Cookies();
        const cart = cookies.get('cart');
        if(cart === undefined) {
            setCartQuantity(0);
        } else {
            let quantity = 0;
            cart.forEach((item) => {
                quantity += item.quantity;
            });
            setCartQuantity(quantity);
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