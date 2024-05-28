import React, { useContext, useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { Avatar, Button, Card, CardContent, TextField } from "@mui/material";
import Cookies from "universal-cookie";
import JWTContext from "../JWTContext";

const styles = {
    blackButton: {
        backgroundColor: 'black',
        color: 'white',
    },
};

export default function UpdatedProfileCard({ userData, onUpdate, setIsUpdated }) {
    const navigate = useNavigate();
    const { setToken } = useContext(JWTContext);
    const [updatedData, setUpdatedData] = useState({
        first_name: "",
        last_name: "",
        email: "",
        password: ""
    });
    const [updateSuccess, setUpdateSuccess] = useState(false); 

    useEffect(() => {
        if (userData) {
            setUpdatedData({
                first_name: userData.first_name,
                last_name: userData.last_name,
                email: userData.email,
                password: ""
            });
        }
    }, [userData]);

    const handleLogout = () => {
        setToken(null);
        const cookies = new Cookies();
        cookies.remove('refresh_token');
        navigate('/login');
    };

    const handleUpdate = () => {
        onUpdate(updatedData);
        setUpdateSuccess(true);
    };

    const handleChange = (event) => {
        setUpdatedData({
            ...updatedData,
            [event.target.name]: event.target.value
        });
    };

    const handleProfile = () => {
        setIsUpdated(false);
    };

    return (
        userData ? (
            <Card className="w-2/3 md:w-1/2 lg:w-1/3 bg-white rounded-lg border border-gray-200 shadow-md">
                <CardContent className="border-t border-gray-200">
                    <div className="flex items-center space-x-4 p-5">
                        <Avatar src={userData.avatar} alt={`${userData.first_name} Picture`} className="aspect-square" />
                        <div>
                            <h2 className="text-2xl font-bold">{userData.first_name}</h2>
                            <p className="text-gray-600">{userData.last_name}</p>
                        </div>
                    </div>
                    <div className="flex flex-col p-5 space-y-3">
                        <TextField label="First Name" name="first_name" value={updatedData.first_name} onChange={handleChange} />
                        <TextField label="Last Name" name="last_name" value={updatedData.last_name} onChange={handleChange} />
                        <TextField label="Email" name="email" value={updatedData.email} onChange={handleChange} />
                        <TextField label="Password" name="password" type="password" value={updatedData.password} onChange={handleChange} />
                        {updateSuccess && <p style={{ color: 'green' }}>Mise à jour réussie!</p>}
                        <Button variant="contained" className='w-full' onClick={handleUpdate} style={{...styles.submit, ...styles.blackButton}}>Update</Button>
                        <Button variant="contained" className='w-full' onClick={handleProfile} style={{...styles.submit, ...styles.blackButton}}>Voir Profile</Button>
                        <Button variant="contained" className='w-full' onClick={handleLogout} style={{...styles.submit, ...styles.blackButton}}>Logout</Button>
                    </div>
                </CardContent>
            </Card>
        ) : null
    );
}
// Path: frontend/src/Components/ProfileCardUpdate.jsx