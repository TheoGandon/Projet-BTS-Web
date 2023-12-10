import Navbar from './component/Navbar'
import "./css/Commande.css"
import Footer from './component/Footer'
import Dunk from './Asset/dunk.PNG'

function Commande() {
    return(
        <div>
            <Navbar />
            <h2 className='commande-t'>Commande</h2>
            <div className='commande'>
                <div className='commande-d'>
                    <h3>ID Commande</h3>
                    <h3>Etat Commande</h3>
                    <h3>Date de livraison estime</h3>
                </div>
                <div className='commande-d'>
                    <h3>Paiment</h3>
                    <h3>Retrait / Livraison</h3>
                    <h3>Date de Commande</h3>
                </div>
            </div>
            <img src={Dunk} className='commande-img' />
            <Footer />
        </div>
    );
}

export default Commande;

