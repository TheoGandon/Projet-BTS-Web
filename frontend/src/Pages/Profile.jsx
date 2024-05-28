import React, { useContext, useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

import ProfileCard from "../Components/ProfileCard";
import UpdatedProfileCard from "../Components/ProfileCardUpdate";
import Loading from "../Components/LoadingScreen";
import JWTContext from "../JWTContext";

export default function Profile() {
    const { jwt, checkToken } = useContext(JWTContext);
    const [userData, setUserData] = useState(null);
    const [isUpdated, setIsUpdated] = useState(false);
    const [forceRender, setForceRender] = useState(false);
    const navigate = useNavigate();

    checkToken();

    useEffect(() => {
        function fetchUserData() {
            axios.get('http://localhost:8080/api/client', {
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
    }, [jwt, navigate, forceRender]);

    const updateUserData = (updatedData) => {
        axios.patch('http://localhost:8080/api/client', updatedData, {
            headers: {
                Authorization: `Bearer ${jwt}`
            }
        })
        .then(response => response.data)
        .then(data => {
            setUserData(data);
            setIsUpdated(true);
            setForceRender(prevState => !prevState);
        })
        .catch(() => {
            console.log('Erreur dans le updateUserData');
        })
    }

    return (
        <div className="w-full min-h-hero flex justify-center items-center">
            {userData === null ? <Loading /> : 
            (isUpdated ? <UpdatedProfileCard userData={userData} onUpdate={updateUserData} setIsUpdated={setIsUpdated}/> : <ProfileCard userData={userData} onUpdate={updateUserData} setIsUpdated={setIsUpdated} />
            )}
        </div>
    )
}
