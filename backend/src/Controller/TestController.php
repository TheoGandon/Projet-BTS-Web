<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/openapi/test', name: 'app_apitest')]
    public function index(ClientRepository $clientRepository): Response
    {

        $request = $_SERVER;
        // $users = $clientRepository->findAll();
        $response = new Response("THIS IS A TEST RESPONSE");
        $response->headers->add(['Set-Cookie'=>'testCookie_jqzdqn=new;path=/;httpOnly;SameSite=none;']);


        return $response;
    }

    #[Route('/openapi/get', name: 'app_apitest1')]
    public function getAPI():Response
    {
        $request = $_SERVER;
        return new JsonResponse($request);
    }
}
