<?php

namespace App\Controller;

use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isNull;

class GetProductsController extends AbstractController
{
    #[Route('/api/get/products', name: 'app_get_products')]
    public function getProducts(ArticlesRepository $articlesRepository): Response
    {
        $articles = $articlesRepository->findAll();

        $data = [];

        foreach ($articles as $article){
            $data[] = [
                'id' => $article->getId(),
                'title' => $article->getArticlTitle(),
                'decription' => $article->getArticleDescription(),
                'selling_price' => $article->getArticleSellingPrice(),
                'selling_price_promo' => $article->getArticleSellingPricePromotion()
            ];
        }

        return new JsonResponse($data);
    }
}
