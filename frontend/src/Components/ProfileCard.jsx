import React, {useContext} from 'react';
import {useNavigate} from 'react-router-dom';
import {Avatar, Button, Card, CardContent} from "@mui/material";
import Cookies from "universal-cookie";
import JWTContext from "../JWTContext";

const styles = {
    blackButton: {
        backgroundColor: 'black',
        color: 'white', // Couleur du texte
    },
};

export default function ProfileCard(props) {
    const navigate = useNavigate();
    const {setToken} = useContext(JWTContext);

    const handleLogout = (() => {
        setToken(null);
        const cookies = new Cookies();
        cookies.remove('refresh_token');
        navigate('/login');
    });

    return (
        <Card className="w-2/3 md:w-1/2 lg:w-1/3 bg-white rounded-lg border border-gray-200 shadow-md">
            <CardContent className="border-t border-gray-200">
                <div className="flex items-center space-x-4 p-5">
                    <Avatar src={props.userData.avatar} alt={props.userData.first_namename + " Picture"} className="aspect-square" />
                    <div>
                        <h2 className="text-2xl font-bold">{props.userData.first_name}</h2>
                        <p className="text-gray-600">{props.userData.last_name}</p>
                    </div>
                </div>
                <div className="flex flex-col p-5 space-y-3">
                    <div className="flex flex-col space-y-1">
                        <label className="text-sm font-medium text-gray-900" htmlFor="email">
                            Email
                        </label>
                        <div className="text-sm text-gray-500" id="email">
                            {props.userData.email}
                        </div>
                    </div>
                    <div className="flex flex-col space-y-1">
                        <label className="text-sm font-medium text-gray-900" htmlFor="id">
                            ID
                        </label>
                        <div className="text-sm text-gray-500" id="id">
                            {props.userData.id}
                        </div>
                    </div>
                    <Button variant="contained" className='w-full' onClick={handleLogout}
                            style={{...styles.submit, ...styles.blackButton}}>Logout</Button>
                </div>
            </CardContent>
        </Card>
    )
}