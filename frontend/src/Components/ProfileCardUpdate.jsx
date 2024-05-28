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

export default function UpdatedProfileCard({ userData, onUpdate, setIsUpdated, onAddAddress }) {
    const navigate = useNavigate();
    const { setToken } = useContext(JWTContext);
    const [updatedData, setUpdatedData] = useState({
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        street: "",
        street2: "",
        postalcode: "",
        city: "",
        country: "",
        phonenr: ""
    });
    const [newAddress, setNewAddress] = useState({
        street: "",
        street2: "",
        postalcode: "",
        city: "",
        country: "",
        phonenr: ""
    });
    const [updateSuccess, setUpdateSuccess] = useState(false);

    useEffect(() => {
        if (userData) {
            const address = userData.addresses && userData.addresses.length > 0 ? userData.addresses[0] : {};
            setUpdatedData({
                first_name: userData.first_name,
                last_name: userData.last_name,
                email: userData.email,
                password: "",
                street: address.street || "",
                street2: address.street2 || "",
                postalcode: address.postalcode || "",
                city: address.city || "",
                country: address.country || "",
                phonenr: address.phonenr || ""
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

    const handleAddressChange = (event) => {
        setNewAddress({
            ...newAddress,
            [event.target.name]: event.target.value
        });
    };

    const handleAddAddress = () => {
        onAddAddress(newAddress);
        setNewAddress({
            street: "",
            street2: "",
            postalcode: "",
            city: "",
            country: "",
            phonenr: ""
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
                        <Button variant="contained" className='w-full' onClick={handleProfile} style={{...styles.submit, ...styles.blackButton}}>Voir Profile</Button>                    </div>
                    <div className="flex flex-col p-5 space-y-3">
                        <h2 className="text-2xl font-bold">Add New Address</h2>
                        <TextField label="Street" name="street" value={newAddress.street} onChange={handleAddressChange} />
                        <TextField label="Street 2" name="street2" value={newAddress.street2} onChange={handleAddressChange} />
                        <TextField label="Postal Code" name="postalcode" value={newAddress.postalcode} onChange={handleAddressChange} />
                        <TextField label="City" name="city" value={newAddress.city} onChange={handleAddressChange} />
                        <TextField label="Country" name="country" value={newAddress.country} onChange={handleAddressChange} />
                        <TextField label="Phone Number" name="phonenr" value={newAddress.phonenr} onChange={handleAddressChange} />
                        <Button variant="contained" className='w-full' onClick={handleAddAddress} style={{...styles.submit, ...styles.blackButton}}>Add Address</Button>
                    </div>
                </CardContent>
            </Card>
        ) : null
    );
}
