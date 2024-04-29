import { useParams } from "react-router-dom";
import DetailsProductCard from "../Components/DetailsProductCard.";
import React, {useState, useEffect, useContext} from "react";
import JWTContext from "../JWTContext";


export default function P(){
    const {jwt, checkToken} = useContext(JWTContext);
    const routeParams = useParams();
    const [item, setItem] = useState();

    checkToken();

    useEffect(()=>{
        const fetchProductById = ()=>{
            fetch("http://localhost:8080/api/articles/" + routeParams.id.toString(), {headers: {
                Authorization: `Bearer ${jwt}`
            }})
                .then((response)=>response.json())
                .then((data)=>{
                    setItem(data)
                })
                .catch((error)=>{console.log("IMPOSSIBLE DE RECUPERER LES ITEMS : " + error)});
        };

        fetchProductById()
    }, [routeParams.id])

    return(
        <div className="min-h-hero flex flex-wrap justify-center items-center">
            {item === undefined ? <p>Chargement...</p> : <DetailsProductCard data={item}/> }
        </div>
    )
}