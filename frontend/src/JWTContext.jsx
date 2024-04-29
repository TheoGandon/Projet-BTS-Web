import React, {createContext, useCallback, useState} from "react";
import Cookies from "universal-cookie";
import axios from "axios";

const JWTContext = createContext("");

export const JWTProvider = ({ children }) => {
    const [jwt, setJwt] = useState('');

    const setToken = (token) => {
        setJwt(token);
    };

    const checkToken = useCallback(() => {
        if (jwt === null || jwt === undefined || jwt === "") {
            const cookies = new Cookies();
            if (cookies.get('refresh_token') !== undefined) {
                axios.get('http://localhost:8080/api/token/refresh', {
                    refresh_token: cookies.get('refresh_token')
                })
                    .then(response => response.data)
                    .then(data => {
                        setToken(data.token);
                        cookies.set('refresh_token', data.refresh_token, {path: '/'});
                    })
                    .catch((error) => {
                        cookies.remove('refresh_token')
                        console.error(error)
                    })
            }
        }
    }, [jwt]);

    return (
        <JWTContext.Provider value={{jwt, setToken, checkToken}}>
            {children}
        </JWTContext.Provider>
    );
};

export default JWTContext;