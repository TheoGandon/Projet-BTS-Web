<?php

namespace App\Controller;

use App\Entity\Address;
use App\Repository\AddressRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/api/addaddress', name: 'add_address')]
    public function addAddress(ClientRepository $clientRepository, Request $request, EntityManagerInterface $manager, ): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "POST") {
            $session = $request->getSession();
            $loginsession = $session->get("loginsession");
            if (!is_null($loginsession)) {
                $address = new Address();
                $address->setClientId($clientRepository->find($loginsession["id"]));
                $address->setAddressStreet($_POST["address1"]);
                if(isset($_POST["address2"])){
                    $address->setAddressStreet2($_POST["address2"]);
                }
                $address->setAddressPostalCode($_POST["postcode"]);
                $address->setAddressCity($_POST["city"]);
                $address->setAddressCountry($_POST["country"]);
                $address->setAddressPhoneNumber($_POST["phonenumber"]);

                $manager->persist($address);
                $manager->flush();

                return new JsonResponse([
                    'status'=>200,
                    'value'=>'Address added successfully!'
                ]);
            }else {
                return new JsonResponse([
                    'status' => 500,
                    'error' => 'User Not Connected'
                ]);
            }
        } else {
            return new JsonResponse([
                'status' => 500,
                'error' => 'Incorrect Method'
            ]);
        }
    }
}
