<?php

namespace App\Controller;

use App\Repository\ArticlePictureRepository;
use App\Repository\ArticleRepository;
use App\Repository\ColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetProductsController extends AbstractController
{
    #[Route('/api/get/articles', name: 'app_get_products')]
    public function getProducts(ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $articles = $articleRepository->findAll();

        $data = [];

        foreach ($articles as $article){
            $id = $article->getId();
            $title = $article->getArticleTitle();
            $selling_price = $article->getSellingPrice();
            $pictures = $articleRepository->getArticlePictures($id);
            $colors = $articleRepository->getArticleColors($id);
            $sizes = $articleRepository->getAvailableArticleSizes($id);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'selling_price' => $selling_price,
                'pictures' => $pictures,
                'colors' => $colors,
                'available_sizes'=> $sizes
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/get/articles/by/color/{color_id}', name: 'app_get_products_by_color')]
    public function getProductsByColor(string $color_id, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $articles = $articleRepository->findArticlesByColor($color_id);

        $data = [];

        foreach ($articles as $article){
            $id = $article["id"];
            $title = $article["article_title"];
            $selling_price = $article["selling_price"];
            $pictures = $articleRepository->getArticlePictures($id);
            $colors = $articleRepository->getArticleColors($id);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'selling_price' => $selling_price,
                'pictures' => $pictures,
                'colors' => $colors
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/get/articles/by/size/{size_id}', name: 'app_get_products_by_size')]
    public function getArticleBySize(string $size_id, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findArticlesBySize($size_id);

        $data = [];

        foreach ($articles as $article){
            $id = $article["id"];
            $title = $article["article_title"];
            $selling_price = $article["selling_price"];
            $pictures = $articleRepository->getArticlePictures($id);
            $colors = $articleRepository->getArticleColors($id);
            $sizes = $articleRepository->getAvailableArticleSizes($id);

            $data[] = [
                'id' => $id,
                'title' => $title,
                'selling_price' => $selling_price,
                'pictures' => $pictures,
                'colors' => $colors,
                'available_sizes' => $sizes
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/get/articles/{id}', name: 'app_get_single_product')]
    public function getSingleProduct(int $id, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $article = $articleRepository->find($id);

        $id = $article->getId();
        $title = $article->getArticleTitle();
        $description = $article->getArticleDescription();
        $selling_price = $article->getSellingPrice();
        $pictures = $articleRepository->getArticlePictures($id);
        $color = $articleRepository->getArticleColors($id);
        $sizes = $articleRepository->getAvailableArticleSizes($id);



        $response = [
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'selling_price' => $selling_price,
            'pictures' => $pictures,
            'color' => $color,
            'sizes' => $sizes
        ];

        return new JsonResponse($response);
    }
}
