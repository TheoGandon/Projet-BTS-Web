import {useContext, useEffect, useState} from "react";
import Cookies from "universal-cookie";
import {Card, CardContent} from "@mui/material";
import {Link} from "react-router-dom";
import cartContext from "../CartContext";

export default function CartCard(){
    const [cartContent, setCartContent] = useState([])
    const [cartTotals, setCartTotals] = useState({total: 0, items: 0})
    const {updateCartQuantity} = useContext(cartContext);


    const handleDeleteFromCart = (event) => {
        const index = cartContent.findIndex(
            (item) => item.id === parseInt(event.target.value)
        );
        let cartTmp = cartContent;
        cartTmp.splice(index, 1);
        const cookies = new Cookies();
        cookies.set("cart", cartTmp, { path: "/" });
        setCartContent(cartTmp);
        updateCartQuantity();
        updateCartTotals();
    };

    const updateCartTotals = () => {
        if (cartContent !== undefined) {
            let total = 0;
            let items = 0;
            cartContent.forEach((item) => {
                total += item.price;
                items += item.quantity;
            });
            setCartTotals({ total: total, items: items });
        }
    }


    useEffect(() => {
        const cookies = new Cookies();
        let cart = cookies.get('cart');
        setCartContent(cart);
    }, []);

    useEffect(() => {
        if (cartContent !== undefined) {
            let total = 0;
            let items = 0;
            cartContent.forEach((item) => {
                total += item.price;
                items += item.quantity;
            });
            setCartTotals({ total: total, items: items });
        }
    }, [cartContent]);

    return(
        <Card className="w-5/6 md:w-2/3 lg:w-1/2">
            <CardContent>
                { cartContent === undefined || cartContent.length === 0 ? <p className="w-full text-center">Votre panier est vide</p> : <div>
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
                            {cartContent.map((item, index) => {
                                return(
                                    <tr key={index}>
                                        <td className="italic underline hover:font-semibold"><Link to={"/p/" + item.id} >{item.title}</Link></td>
                                        <td>{item.quantity}</td>
                                        <td>{item.price} €</td>
                                        <td><button onClick={handleDeleteFromCart} value={item.id} className="text-red-600 hover:underline">Del</button></td>
                                    </tr>
                                )
                            })}
                            <tr className="font-bold">
                                <td>Total</td>
                                <td>{cartTotals.items}</td>
                                <td>{cartTotals.total} €</td>
                            </tr>
                        </tbody>
                    </table>
                </div>}
            </CardContent>
        </Card>
    )

}