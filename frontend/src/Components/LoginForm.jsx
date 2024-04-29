import {Button, Card, TextField, CardContent, Alert} from '@mui/material';
import axios from "axios";
import {useContext, useEffect} from "react";
import JWTContext from "../JWTContext";
import Cookies from 'universal-cookie';
import {useNavigate} from "react-router-dom";


const styles = {
    blackButton: {
        backgroundColor: 'black',
        color: 'white', // Couleur du texte
    },
};


export default function LoginForm() {

    const {jwt, setToken} = useContext(JWTContext);
    const navigate = useNavigate();

    const handleSubmit = (event) => {
        event.preventDefault();
        let inputEmail = document.getElementById('outlined-email-required').value.toLowerCase();
        let inputPassword = document.getElementById('outlined-password-input').value;
        let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (inputEmail.match(validRegex)) {
            if (inputPassword.length >= 3) {
                let loginObject = {
                    email: inputEmail,
                    password: inputPassword
                };
                loginMethod(loginObject);
            } else {
                document.querySelector('#pwdErrorAlert').classList.remove('!hidden');
                setTimeout(() => {
                    document.querySelector('#pwdErrorAlert').classList.add('!hidden');
                }, 3000);
            }
        } else {
            document.querySelector('#emailErrorAlert').classList.remove('!hidden');
            setTimeout(() => {
                document.querySelector('#emailErrorAlert').classList.add('!hidden');
            }, 3000);
        }

    };

    const loginMethod = (async (loginObject) => {
        await axios.post('http://localhost:8080/api/login_check', loginObject)
            .then(response => response.data)
            .then(data => {
                setToken(data.token);
                const cookies = new Cookies();
                cookies.set('refresh_token', data.token, {path: '/'});
                navigate('/profile');
            })
            .catch(() => {
                document.querySelector('#loginErrorAlert').classList.remove('!hidden');
                setTimeout(() => {
                    document.querySelector('#loginErrorAlert').classList.add('!hidden');
                }, 3000);
            });
    });

    useEffect(() => {
        if(jwt !== "" && jwt !== undefined && jwt !== null){
            navigate('/profile');
        }
    }, [jwt, navigate])

    return (<div className="w-2/3 md:1/2 lg:w-1/3">
                <Card className="w-full">
                    <CardContent className="space-y-4">
                        <h3 className="text-2xl font-bold">Login</h3>
                        <h4>Entrez votre email et votre mot de passe pour<br></br> accéder à votre compte.</h4>
                        <div id="alert_box">
                            <Alert severity="error" id="loginErrorAlert" className="!hidden">Connexion échouée !</Alert>
                            <Alert severity="error" id="emailErrorAlert" className="!hidden">Votre email ne correspond
                                pas
                                aux critères.</Alert>
                            <Alert severity="error" id="pwdErrorAlert" className="!hidden">Votre mot de passe ne
                                respecte
                                pas les critères de sécurité.</Alert>
                        </div>
                        <div className="space-y-2">
                            <TextField
                                required
                                id="outlined-email-required"
                                label="Email"
                                className='w-full'
                            />
                        </div>
                        <div className="space-y-2">
                            <TextField
                                id="outlined-password-input"
                                label="Password"
                                type="password"
                                autoComplete="current-password"
                                required
                                className='w-full'
                            />
                        </div>
                        <div className="space-y-2">
                            <Button variant="contained" className='w-full' onClick={handleSubmit}
                                    style={{...styles.submit, ...styles.blackButton}}>Login</Button>
                        </div>
                    </CardContent>
                </Card>
            </div>
    );

}