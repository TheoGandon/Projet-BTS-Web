import {Link} from "react-router-dom";
import React from "react";

function FacebookIcon(props) {
    return (
        <svg
            {...props}
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
        >
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
        </svg>
    )
}


function InstagramIcon(props) {
    return (
        <svg
            {...props}
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
        >
            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
        </svg>
    )
}


function TwitterIcon(props) {
    return (
        <svg
            {...props}
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
        >
            <path
                d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
        </svg>
    )
}

export default function Footer() {
    return (
        <footer className="w-full py-6 bg-gray-100 flex flex-wrap justify-center">
            <div className="container flex justify-center">
                <div className="w-full flex flex-wrap text-center justify-around">
                    <div className="w-full flex flex-wrap justify-start mb-4 lg:w-1/5">
                        <p className="w-full font-semibold">Sneak Hub</p>
                        <p className="w-full text-sm text-gray-500 dark:text-gray-400">Meilleur Site de vente de Sneakers de France</p>
                    </div>
                    <div className="w-full mb-4 lg:w-1/5">
                        <p className="w-full font-semibold">Liens utiles</p>
                        <ul className="w-full list-disc list-inside">
                            <li><Link to="/">Home</Link></li>
                            <li><Link to="/products">Products</Link></li>
                            <li><Link to="/login">Login</Link></li>
                        </ul>
                    </div>
                    <div className="w-full mb-4 lg:w-1/5">
                        <p className="font-semibold">Nous contacter</p>
                        <p>EPSI Lille</p>
                        <p>2 Rue Alphonse Colas</p>
                        <p>59000, Lille, France</p>
                    </div>
                    <div className="w-full lg:w-1/5">
                        <p className="font-semibold mb-2">Nous retrouver</p>
                        <ul className="flex gap-2 justify-center">
                            <li><span className="sr-only">Facebook</span><FacebookIcon className="w-4 h-4"/>
                            </li>
                            <li><span className="sr-only">Twitter</span><TwitterIcon className="w-4 h-4"/></li>
                            <li><span className="sr-only">Instagram</span><InstagramIcon className="w-4 h-4"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    )
}