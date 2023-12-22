<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/categories', name: 'app_get_categories')]
    public function getCategories(CategoryRepository $categoryRepository): Response
    {
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $categories = $categoryRepository->findAll();
            $data = [];
            foreach ($categories as $category){
                $data[] = [
                    'id'=>$category->getId(),
                    'name'=>$category->getCategoryName()
                ];
            }
            return new JsonResponse($data);
        } else {
            return new Response('wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}
