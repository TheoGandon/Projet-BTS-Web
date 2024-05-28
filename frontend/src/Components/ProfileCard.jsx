import React, {useContext} from 'react';
import {useNavigate} from 'react-router-dom';
import {Avatar, Button, Card, CardContent, Typography, List, ListItem} from "@mui/material";
import Cookies from "universal-cookie";
import JWTContext from "../JWTContext";

const styles = {
    blackButton: {
        backgroundColor: 'black',
        color: 'white', // Couleur du texte
    },
};

export default function ProfileCard({ userData, onUpdate}) {
    const navigate = useNavigate();
    const {setToken} = useContext(JWTContext);

    const handleLogout = (() => {
        setToken(null);
        const cookies = new Cookies();
        cookies.remove('refresh_token');
        navigate('/login');
    });

    const handleUpdate = () => {
        onUpdate();
    } 

    if (!userData) {
        return null; // or a loading component, or whatever you want to display while data is loading
    }

    return (
        <Card className="w-2/3 md:w-1/2 lg:w-1/3 bg-white rounded-lg border border-gray-200 shadow-md">
            <CardContent className="border-t border-gray-200">
                <div className="flex items-center space-x-4 p-5">
                    <Avatar src={userData.avatar} alt={userData.first_name + " Picture"} className="aspect-square" />
                    <div>
                        <h2 className="text-2xl font-bold">{userData.first_name}</h2>
                        <p className="text-gray-600">{userData.last_name}</p>
                    </div>
                </div>
                <div className="flex flex-col p-5 space-y-3">
                    <div className="flex flex-col space-y-1">
                        <label className="text-sm font-medium text-gray-900" htmlFor="email">
                            Email
                        </label>
                        <div className="text-sm text-gray-500" id="email">
                            {userData.email}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-1">
                        <label className="text-sm font-medium text-gray-900" htmlFor="id">
                            ID
                        </label>
                        <div className="text-sm text-gray-500" id="id">
                            {userData.id}
                        </div>
                    </div>
                    {userData.addresses && userData.addresses.map((address, index) => (
                        <Card key={index} variant="outlined" style={{ marginTop: '10px' }}>
                            <CardContent>
                                <Typography color="textSecondary" gutterBottom>
                                    Address {index + 1}
                                </Typography>
                                <Typography variant="body2" component="p">
                                    {address.street}, {address.street2}
                                </Typography>
                                <Typography variant="body2" component="p">
                                    {address.postalcode}, {address.city}, {address.country}
                                </Typography>
                                <Typography variant="body2" component="p">
                                    Phone: {address.phonenr}
                                </Typography>
                            </CardContent>
                        </Card>
                    ))}
                    <Button variant="contained" className='w-full' onClick={handleUpdate}
                            style={{...styles.submit, ...styles.blackButton}}>Modifier Profile</Button>
                    <Button variant="contained" className='w-full' onClick={handleLogout}
                            style={{...styles.submit, ...styles.blackButton}}>Logout</Button>
                </div>
            </CardContent>
        </Card>
    )
}