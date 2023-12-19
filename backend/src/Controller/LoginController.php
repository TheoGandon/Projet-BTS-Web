<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_login')]
    public function login(ClientRepository $clientRepository){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "POST"){
            /*$email = $_POST["email"];
            $password = $_POST["password"];

            $client = $clientRepository->findBy(array("client_email" => $email));

            return new Response($client);*/
            return new Response('Hello my Friend ! ');
        }

        return new Response($method);
    }
}
