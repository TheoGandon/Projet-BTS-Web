import {useContext, useEffect, useState} from "react";
import JWTContext from "../JWTContext";
import {useNavigate} from "react-router-dom";
import axios from "axios";


import ProfileCard from "../Components/ProfileCard";

export default function Profile() {
    const {jwt, checkToken} = useContext(JWTContext);
    const [userData, setUserData] = useState(null);
    const navigate = useNavigate();

    checkToken();

    useEffect(() => {
         function fetchUserData() {
            axios.get('http://localhost:8080/api/getinfos', {
                headers: {
                    Authorization: `Bearer ${jwt}`
                }
            })
                .then(response => response.data)
                .then(data => {
                    setUserData(data);
                })
                .catch(() => {
                    console.log('Erreur dans le fetchUserData');
                })

        }

        if (jwt !== "") {
            fetchUserData();
        } else {
            navigate('/login')
        }
    }, [jwt, navigate])

    return (<div className="w-full min-h-hero flex justify-center items-center">
        {userData === null ? <div>Loading</div> : <ProfileCard userData={userData}/>}
    </div>)
}