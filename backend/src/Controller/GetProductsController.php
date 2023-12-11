<?php

namespace App\Controller;

use App\Repository\ArticlePictureRepository;
use App\Repository\ArticlesRepository;
use App\Repository\ColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\isNull;

class GetProductsController extends AbstractController
{
    #[Route('/api/get/products', name: 'app_get_products')]
    public function getProducts(ArticlesRepository $articlesRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $articles = $articlesRepository->findAll();

        $data = [];

        foreach ($articles as $article){
            $id = $article->getId();
            $title = $article->getArticleTitle();
            $description = $article->getArticleDescription();
            $selling_price = $article->getArticleSellingPrice();
            $selling_price_promo = $article->getArticleSellingPricePromotion();
            $pictures_objects = $articlePictureRepository->findBy(["article_id"=>$id], );
            $pictures = array_map(function($picture) {
                return $picture->getPictureLink();
            }, $pictures_objects);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'selling_price' => $selling_price,
                'selling_price_promo' => $selling_price_promo,
                'pictures' => $pictures
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/get/products/by/color/{color}', name: 'app_get_products_by_color')]
    public function getProductsByColor(string $color, ArticlesRepository $articlesRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $articles = $articlesRepository->findAll();

        $data = [];

        foreach ($articles as $article){
            $id = $article->getId();
            $title = $article->getArticleTitle();
            $description = $article->getArticleDescription();
            $selling_price = $article->getArticleSellingPrice();
            $selling_price_promo = $article->getArticleSellingPricePromotion();
            $pictures_objects = $articlePictureRepository->findBy(["article_id"=>$id], );
            $pictures = array_map(function($picture) {
                return $picture->getPictureLink();
            }, $pictures_objects);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'selling_price' => $selling_price,
                'selling_price_promo' => $selling_price_promo,
                'pictures' => $pictures
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/get/product/{id}', name: 'app_get_single_product')]
    public function getSingleProduct(int $id, ArticlesRepository $articlesRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $article = $articlesRepository->find($id);

        $id = $article->getId();
        $title = $article->getArticleTitle();
        $description = $article->getArticleDescription();
        $selling_price = $article->getArticleSellingPrice();
        $selling_price_promo = $article->getArticleSellingPricePromotion();
        $pictures_objects = $articlePictureRepository->findBy(["article_id"=>$id], );
        $pictures = array_map(function($picture) {
            return $picture->getPictureLink();
        }, $pictures_objects);

        $response = [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'selling_price' => $selling_price,
            'selling_price_promo' => $selling_price_promo,
            'pictures' => $pictures
        ];

        return new JsonResponse($response);
    }
}
