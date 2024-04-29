import {Button, Card, CardContent} from '@mui/material';
import { Link } from 'react-router-dom';
import {useContext, useEffect} from "react";
import JWTContext from "../JWTContext";

const styles = {
  // ... (autres styles)

  blackButton: {
    backgroundColor: 'black',
    color: 'white', // Couleur du texte
  },
};

function Home() {
    const {jwt, checkToken} = useContext(JWTContext);

    useEffect(()=>{
        checkToken();
    }, [checkToken, jwt])

    return (
      <div className="h-hero flex flex-wrap justify-center content-center">
        <div className='w-2/3 md:w-1/2 flex flex-wrap justify-between'>
            <Card className='w-full h-full text-center'>
              <CardContent>
                <h1 className="text-4xl font-bold mb-6">BIENVENUE SUR SNEAK HUB</h1>
                <h3 className='text-2xl mb-6'>Découvrez nos produits !</h3>
                <p className='mb-6'>(Bon, c'est un peu le bordel, mais y'a des trucs qui vont vous aider à trouver ce que vous cherchez)</p>
                <Link to="/products">
                  <Button variant="contained" style={{...styles.blackButton}}>VERS NOTRE PAGE PRODUITS</Button>
                </Link>
              </CardContent>
            </Card>
        </div>
      </div>
    );
  }
  
export default Home;