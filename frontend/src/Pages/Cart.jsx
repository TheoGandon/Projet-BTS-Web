import {useContext} from "react";
import JWTContext from "../JWTContext";
import CartCard from "../Components/CartCard";

export default function Cart() {
    const {checkToken} = useContext(JWTContext);
    checkToken();

    return(
        <div className="flex justify-center items-center w-full min-h-hero">
            <CartCard/>
        </div>
    )
}