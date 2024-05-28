import React, {createContext, useCallback, useState} from "react";

const JWTContext = createContext("");

export const JWTProvider = ({ children }) => {
    const [jwt, setJwt] = useState('');

    const setToken = (token) => {
        setJwt(token);
    };

    const checkToken = useCallback(() => {
        if (jwt === null || jwt === undefined || jwt === "") {
            fetch('http://localhost:8080/api/token/refresh', {
                credentials: 'include'
            })
                    .then(response => response.json())
                    .then(data => {
                        setToken(data.token);
                    })
                    .catch(() => {
                        console.error("User not connected.");
                    });
        }
    }, [jwt]);

    return (
        <JWTContext.Provider value={{jwt, setToken, checkToken}}>
            {children}
        </JWTContext.Provider>
    );
};

export default JWTContext;