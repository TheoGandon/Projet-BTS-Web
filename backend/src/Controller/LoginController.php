<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use PHPUnit\Util\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\throwException;

class LoginController extends AbstractController
{
    #[Route('/api/login', name: 'app_login')]
    public function login(ClientRepository $clientRepository, Request $request){
        $method = $_SERVER['REQUEST_METHOD'];
        $session  = $request->getSession();
        if($method == "POST"){
            try {

                $input_email = $_POST['email'];
                $input_password = $_POST["password"];

                $clients = $clientRepository->findLoginClient($input_email);

                $stored_password = $clients[0]["client_password"];

                if (password_verify($input_password, $stored_password)) {
                    $loggedin = $session->get("loginsession", []);
                    $loggedin["id"] = $clients[0]["id"];
                    $loggedin["first_name"] = $clients[0]["client_first_name"];
                    $loggedin["last_name"] = $clients[0]["client_last_name"];
                    $loggedin["email"] = $clients[0]["client_email"];
                    $session->set("loginsession", $loggedin);
                    return new JsonResponse([
                        'response'=>200,
                        'value'=>'User successfully logged in'
                    ]);

                }

            } catch (\Exception $e){
                error_log($e->getMessage());
            }
        }
        return new Response("Unable to login !");
    }

    #[Route('/api/logout', name: 'app_logout')]
    public function logout(ClientRepository $clientRepository, Request $request){
        $session = $request->getSession();
        $loginsession = $session->get("loginsession");
        if(!is_null($loginsession)){
            $session->clear();
            return new JsonResponse([
                'response'=>200,
                'value'=>'Session cleared successfully'
            ]);
        } else {
            return new JsonResponse([
                'response' => 200,
                'value' => 'No session to clear'
            ]);
        }
    }
}

