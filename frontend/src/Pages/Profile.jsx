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

    const addAddress = (newAddress) => {
        axios.post('http://localhost:8080/api/client/adresses', newAddress, {
            headers: {
                Authorization: `Bearer ${jwt}`
            }
        })
        .then(response => {
            console.log('Adresse ajoutée avec succès:', response.data);
            setForceRender(prevState => !prevState);
        })
        .catch(error => {
            console.error('Erreur lors de l\'ajout de l\'adresse:', error);
        });
    };

    // Méthode pour supprimer une adresse
    const deleteAddress = (addressId) => {
        axios.delete(`http://localhost:8080/api/client/adresses/${addressId}`, {
            headers: {
                Authorization: `Bearer ${jwt}`
            }
        })
        .then(response => {
            console.log('Adresse supprimée avec succès:', response.data);
            // Rafraîchir les données de l'utilisateur après la suppression de l'adresse
            setForceRender(prevState => !prevState);
        })
        .catch(error => {
            console.error('Erreur lors de la suppression de l\'adresse:', error);
        });
    };

    return (
        <div className="w-full min-h-hero flex justify-center items-center">
            {userData === null ? <Loading /> : 
            (isUpdated ? <UpdatedProfileCard 
                userData={userData} 
                onUpdate={updateUserData} 
                setIsUpdated={setIsUpdated} 
                onAddAddress={addAddress}
            /> : 
            <ProfileCard 
                userData={userData} 
                onUpdate={updateUserData} 
                setIsUpdated={setIsUpdated} 
                onAddAddress={addAddress} 
                onDeleteAddress={deleteAddress} 
            />)
            }
        </div>
    )
}
