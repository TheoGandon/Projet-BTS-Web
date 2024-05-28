import React from 'react';
import '../css/Loading.css'

const LoadingScreen = () => {
    return (
        <div className="loading-container">
            <div className="spinner"></div>
            <div className="loading-text">Loading...</div>
        </div>
    );
};

export default LoadingScreen;
