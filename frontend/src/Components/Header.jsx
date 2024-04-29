import {Link} from "react-router-dom";
import React, {useContext} from "react";
import JWTContext from "../JWTContext";
import CartContext from "../CartContext";


export default function Header() {
    const {jwt} = useContext(JWTContext);
    const { cartQuantity } = useContext(CartContext);

    return (<nav className="flex items-center h-14 px-4 border-b gap-4 sticky top-0 bg-white z-10">
        <Link className="flex items-center gap-2 text-lg font-semibold" to="/">
            Sneak Hub
        </Link>
        <div className="ml-auto flex items-center gap-4">
            <Link className="font-medium underline underline-offset-2 transition-colors hover:text-gray-900"
                  to="/">
                Home
            </Link>
            {cartQuantity === 0 ? null :
                <Link className="font-medium underline underline-offset-2 transition-colors hover:text-gray-900"
                      to={"/cart"}>Cart ({cartQuantity})</Link>}
            <Link className="font-medium underline underline-offset-2 transition-colors hover:text-gray-900"
                  to="/products">
                Products
            </Link>
            {jwt === null || jwt === undefined || jwt === "" ?
                <Link className="font-medium underline underline-offset-2 transition-colors hover:text-gray-900"
                      to={"/login"}>Login</Link> :
                <Link className="font-medium underline underline-offset-2 transition-colors hover:text-gray-900"
                      to="/profile">My Profile</Link>}
        </div>
    </nav>)
}