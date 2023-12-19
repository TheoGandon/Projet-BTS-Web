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
    public function getProducts(ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $articles = $articleRepository->findAll();

        $data = [];

        foreach ($articles as $article){
            $id = $article->getId();
            $title = $article->getArticleTitle();
            $description = $article->getArticleDescription();
            $selling_price = $article->getArticleSellingPrice();
            $selling_price_promo = $article->getArticleSellingPricePromotion();
            $pictures = $articleRepository->getArticlePictures($id);
            $colors = $articleRepository->getArticleColors($id);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'selling_price' => $selling_price,
                'selling_price_promo' => $selling_price_promo,
                'pictures' => $pictures,
                'colors' => $colors
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/get/products/by/color/{color}', name: 'app_get_products_by_color')]
    public function getProductsByColor(string $color, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $articles = $articleRepository->findAll();

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
            $colors = $article->getArticleColors($id);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'selling_price' => $selling_price,
                'selling_price_promo' => $selling_price_promo,
                'pictures' => $pictures,
                'colors' => $colors
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/get/product/{id}', name: 'app_get_single_product')]
    public function getSingleProduct(int $id, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $article = $articleRepository->find($id);

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
