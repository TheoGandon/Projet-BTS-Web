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

                return new Response('Address added successfully', Response::HTTP_OK);
            }else {
                return new Response('User not logged in', Response::HTTP_FORBIDDEN);
            }
        } else {
            return new Response('Incorrect Method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    #[Route('/api/get_addresses', name: 'app_get_address')]
    public function getAddresses(ClientRepository $clientRepository, AddressRepository $addressRepository,Request $request, EntityManagerInterface $manager, ): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET") {
            $session = $request->getSession();
            $loginsession = $session->get("loginsession");
            if(!is_null($loginsession)){
                $addresses_id = $clientRepository->findAddresses($loginsession['id']);
                $addresses = [];
                foreach ($addresses_id as $address_id){
                    $address = $addressRepository->find($address_id['id']);
                    $addresses[] = [
                        'id'=>$address->getId(),
                        'street'=>$address->getAddressStreet(),
                        'street2'=>$address->getAddressStreet2(),
                        'postalcode'=>$address->getAddressPostalCode(),
                        'city'=>$address->getAddressCity(),
                        'country'=>$address->getAddressCountry(),
                        'phonenr'=>$address->getAddressPhoneNumber()
                    ];
                }
                if(count($addresses) > 0){
                    return new JsonResponse($addresses);
                } else {
                    return new Response('User has no addresses', Response::HTTP_BAD_REQUEST);
                }
            } else {
                return new Response('User not logged in / not allowed', Response::HTTP_FORBIDDEN);
            }
        } else {
            return new Response('Method Not Allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    #[Route('/api/remove_address/{address_id}', name: 'app_remove_address')]
    public function removeAddress(string $address_id, ClientRepository $clientRepository, AddressRepository $addressRepository,Request $request, EntityManagerInterface $manager, ): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "DELETE") {
            $session = $request->getSession();
            $loginsession = $session->get("loginsession");
            if(!is_null($loginsession)){
                $address = $addressRepository->find($address_id);
                $address_clientId = $address->getClientId()
                                            ->getId();
                if($address_clientId == $loginsession['id']){
                    $manager->remove($address);
                    $manager->flush();
                    return new Response('Addreess deleted', Response::HTTP_OK);
                } else {
                    return new Response('The address is not an address of the client', Response::HTTP_BAD_REQUEST);
                }
            } else {
                return new Response('User not logged in', Response::HTTP_FORBIDDEN);
            }
        } else {
            return new Response('Wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}
