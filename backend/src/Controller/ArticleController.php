<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Stock;
use App\Repository\ArticlePictureRepository;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\ColorRepository;
use App\Repository\SizesRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Attributes\Property;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ArticleController extends AbstractController
{
    #[Route('/api/articles', name: 'app_get_articles', methods: ["GET"])]
    public function getArticles(ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {

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
    }

    #[Route('/api/articles', name: 'app_post_article', methods: ["GET"])]
    public function postArticles(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $manager): Response
    {
        try {
            $jsonContent = json_decode($request->getContent());

            $category = $categoryRepository->findOneBy(["id" => $jsonContent->categoryId]);

            $newArticle = new Article();

            $newArticle->setArticleTitle($jsonContent->title);
            $newArticle->setArticleDescription($jsonContent->description);
            $newArticle->setSellingPrice($jsonContent->price);
            $newArticle->setSellingPricePromo($jsonContent->price_promo);
            $newArticle->setCategory($category);

            $manager->persist($newArticle);
            $manager->flush();

            return new JsonResponse($newArticle, Response::HTTP_CREATED);

        } catch (Exception $exception) {
            return new Response(content:$exception, status: Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception) {
            return new Response(Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/api/articles/stock/{articleId}', name: 'app_get_article_with_stocks', methods: ["GET"])]
    #[IsGranted("ROLE_ADMIN")]
    public function getArticleStock(string $articleId, Request $request, ArticleRepository $articleRepository, CategoryRepository $categoryRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository)
    {
        $article = $articleRepository->findOneBy(["id"=>$articleId]);

        if(!$article){
            return new Response(Response::HTTP_NOT_FOUND);
        }

        $data = [
            'id' => $article->getId(),
            'title' => $article->getArticleTitle(),
            'description'=>$article->getArticleDescription(),
            'selling_price' => $article->getSellingPrice(),
            'pictures' => $article->getArticlePictures(),
            'colors' => $articleRepository->getArticleColors($article->getId()),
            'sizes_stock' => $articleRepository->getArticleSizesWithStock($article->getId()),
            'category' => $articleRepository->getArticleCategory($article->getId())
        ];

        return new JsonResponse(data:$data, status:Response::HTTP_OK);
    }

    #[Route('/api/articles/stock/{articleId}', name: 'app_post_stocks', methods: ["POST"])]
    public function postArticleStock(string $articleId, Request $request, ArticleRepository $articleRepository, SizesRepository $sizesRepository)
    {
        $article = $articleRepository->findOneBy(["id"=>$articleId]);

        if(!$article){
            return new Response(Response::HTTP_BAD_REQUEST);
        }

        $jsonrequest = json_decode($request->getContent());

        foreach ($jsonrequest->content as $itemToAdd){
            $jsonItem = json_decode($itemToAdd);
            $sizeId = $jsonItem->sizeId;
            $amount = $jsonItem->amount;

            $size = $sizesRepository->findOneBy(["id"=>$sizeId]);

            $stockEntry = new Stock();
            $stockEntry->setSize($size);
            $stockEntry->setAmount($amount);
            $stockEntry->addArticle($article);

        }

        return new JsonResponse($jsonrequest, status:Response::HTTP_OK);
    }



    #[Route('/api/articles/filter/color/{color_id}', name: 'app_get_products_by_color')]
    public function getProductsByColor(string $color_id, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
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
        if ($method == "GET") {
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
        if ($method == "GET") {
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
                    'category' => $category
                ];
            }

            return new JsonResponse($data);
        } else {
            return new Response('Wrong method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
    }

    #[Route('/api/articles/{id}', name: 'app_get_single_product')]
    public function getSingleProduct(int $id, ArticleRepository $articleRepository, ArticlePictureRepository $articlePictureRepository, ColorRepository $colorRepository): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "GET") {
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
