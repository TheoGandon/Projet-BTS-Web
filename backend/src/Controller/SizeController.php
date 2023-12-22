<?php

namespace App\Controller;

use App\Repository\SizesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SizeController extends AbstractController
{
    #[Route('/api/sizes', name: 'app_get_sizes')]
    public function getSizes(SizesRepository $sizesRepository): Response
    {
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $sizes = $sizesRepository->findAll();
            $data = [];
            foreach ($sizes as $size){
                $data[] = [
                    'id'=>$size->getId(),
                    'label'=>$size->getSizeLabel()
                ];
            }
            return new JsonResponse($data);
        } else {
            return new Response('wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}
