<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class GetProducts extends AbstractController
{
    #[Route("/products/all")]
    public function get(ArticlesRepository $articlesRepository): Response
    {
        $articles = $articlesRepository->findAll();

        $data = [];

        foreach ($articles as $article){
            $data[] = [
                'id' => $article->getArticleId(),
                'title' => $article->getArticleTitle(),
                'description' => $article->getArticleDescription(),
                'selling_price' => $article->getArticleSellingPrice(),
                'selling_price_promo' => $article->getArticleSellingPricePromotion()
            ];
        }

        return new JsonResponse($data);

    }
}