<?php

namespace App\Controller;

use App\Repository\ArticlePictureRepository;
use App\Repository\ArticleRepository;
use App\Repository\ColorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/api/articles', name: 'app_get_products')]
    public function getProducts(ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $articles = $articleRepository->findAll();

            $data = [];

            foreach ($articles as $article) {
                $id = $article->getId();
                $title = $article->getArticleTitle();
                $selling_price = $article->getSellingPrice();
                $pictures = $articleRepository->getArticlePictures($id);
                $colors = $articleRepository->getArticleColors($id);
                $sizes = $articleRepository->getAvailableArticleSizes($id);
                $category = $articleRepository->getArticleCategory($id);

                $data[] = [
                    'id' => $id,
                    'title' => $title,
                    'selling_price' => $selling_price,
                    'pictures' => $pictures,
                    'colors' => $colors,
                    'available_sizes' => $sizes,
                    'category' => $category
                ];
            }

            return new JsonResponse($data);
        } else {
            return new Response('Wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    #[Route('/api/articles/filter/color/{color_id}', name: 'app_get_products_by_color')]
    public function getProductsByColor(string $color_id, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET") {
            $articles = $articleRepository->findArticlesByColor($color_id);

            $data = [];

            foreach ($articles as $article) {
                $id = $article["id"];
                $title = $article["article_title"];
                $selling_price = $article["selling_price"];
                $pictures = $articleRepository->getArticlePictures($id);
                $colors = $articleRepository->getArticleColors($id);
                $category = $articleRepository->getArticleCategory($id);

                $data[] = [
                    'id' => $id,
                    'title' => $title,
                    'selling_price' => $selling_price,
                    'pictures' => $pictures,
                    'colors' => $colors,
                    'category' => $category
                ];
            }

            return new JsonResponse($data);
        } else {
            return new Response('Wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    #[Route('/api/articles/filter/size/{size_id}', name: 'app_get_products_by_size')]
    public function getArticleBySize(string $size_id, ArticleRepository $articleRepository): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET") {
            $articles = $articleRepository->findArticlesBySize($size_id);

            $data = [];

            foreach ($articles as $article) {
                $id = $article["id"];
                $title = $article["article_title"];
                $selling_price = $article["selling_price"];
                $pictures = $articleRepository->getArticlePictures($id);
                $colors = $articleRepository->getArticleColors($id);
                $sizes = $articleRepository->getAvailableArticleSizes($id);
                $category = $articleRepository->getArticleCategory($id);

                $data[] = [
                    'id' => $id,
                    'title' => $title,
                    'selling_price' => $selling_price,
                    'pictures' => $pictures,
                    'colors' => $colors,
                    'available_sizes' => $sizes,
                    'category' => $category
                ];
            }

            return new JsonResponse($data);
        } else {
            return new Response('Wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    #[Route('/api/articles/filter/category/{category_id}', name: 'app_get_products_by_category')]
    public function getArticleByCategory(string $category_id, ArticleRepository $articleRepository): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET") {
            $articles = $articleRepository->findArticlesByCategory($category_id);

            $data = [];

            foreach ($articles as $article) {
                $id = $article["id"];
                $title = $article["article_title"];
                $selling_price = $article["selling_price"];
                $pictures = $articleRepository->getArticlePictures($id);
                $colors = $articleRepository->getArticleColors($id);
                $sizes = $articleRepository->getAvailableArticleSizes($id);
                $category = $articleRepository->getArticleCategory($id);

                $data[] = [
                    'id' => $id,
                    'title' => $title,
                    'selling_price' => $selling_price,
                    'pictures' => $pictures,
                    'colors' => $colors,
                    'available_sizes' => $sizes,
                    'category'=> $category
                ];
            }

            return new JsonResponse($data);
        } else {
            return new Response('Wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    #[Route('/api/get/articles/{id}', name: 'app_get_single_product')]
    public function getSingleProduct(int $id, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET") {
            $article = $articleRepository->find($id);

            $id = $article->getId();
            $title = $article->getArticleTitle();
            $description = $article->getArticleDescription();
            $selling_price = $article->getSellingPrice();
            $pictures = $articleRepository->getArticlePictures($id);
            $color = $articleRepository->getArticleColors($id);
            $sizes = $articleRepository->getAvailableArticleSizes($id);
            $category = $articleRepository->getArticleCategory($id);


            $response = [
                'id' => $id,
                'title' => $title,
                'description' => $description,
                'selling_price' => $selling_price,
                'pictures' => $pictures,
                'color' => $color,
                'sizes' => $sizes,
                'category' => $category
            ];

            return new JsonResponse($response);
        } else {
            return new Response('Wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }
}
