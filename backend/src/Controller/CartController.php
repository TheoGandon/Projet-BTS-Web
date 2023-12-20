<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\ClientRepository;
use App\Repository\SizesRepository;
use PHPUnit\Util\Json;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/api/addtocart/{article_id}-{size_id}', name: 'app_addtocart')]
    public function addToCart(string $article_id, string $size_id, ArticleRepository $articleRepository, ClientRepository $clientRepository, SizesRepository $sizesRepository, Request $request): Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "POST"){
            $session  = $request->getSession();
            $loginsession = $session->get('loginsession');
            if(!is_null($loginsession)){
                $article = $articleRepository->find($article_id);
                $size = $sizesRepository->find($size_id);
                $cart = $session->get("cart", []);
                $cart[] = [
                    'id'=>$article->getId(),
                    'article_title'=>$article->getArticleTitle(),
                    'selling_price'=>$article->getSellingPrice(),
                    'selling_price_promo'=>$article->getSellingPricePromo(),
                    'size_id'=>$size->getId(),
                    'size_label'=>$size->getSizeLabel()
                ];
                $session->set("cart", $cart);
                return new JsonResponse([
                    'status'=>200,
                    'value'=>'Article succesfully added to cart'
                ]);
            } else {
                return new JsonResponse([
                    'status'=>500,
                    'error'=>'User not authentified'
                ]);
            }
        } else {
            return new JsonResponse([
                'status'=> 500,
                'error'=> 'Wrong Method'
            ]);
        }
    }

    #[Route('/api/getcart', name: 'app_getcart')]
    public function getCart(Request $request):Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "GET"){
            $session = $request->getSession();
            $cart = $session->get("cart");
            if(!is_null($cart)){
                return new JsonResponse($cart);
            } else {
                return new JsonResponse([
                    'status'=>500,
                    'error'=>"Cart is empty"
                ]);
            }

        } else {
            return new JsonResponse([
                'status'=>500,
                'error'=>'Wrong method'
            ]);
        }
    }

    #[Route('/api/deletefromcart/{article_id}-{size_id}', name: 'app_removefromcart')]
    public function removeFromCart(string $article_id, string $size_id, Request $request):Response
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "DELETE"){
            $session = $request->getSession();
            $cart = $session->get("cart");
            if(!is_null($cart)){
                $deletions = 0;
                $i = 0;
                foreach($cart as $cartarticle){
                    if($cartarticle["id"] == $article_id && $cartarticle["size_id"] == $size_id){
                        unset($cart[$i]);
                        $deletions++;
                    }
                    $i++;
                }
                if($deletions>0){
                    $session->set("cart", $cart);
                    return new JsonResponse([
                        'status'=>200,
                        'value'=>'Item deleted successfully'
                    ]);
                } else {
                    return new JsonResponse([
                        'status'=>500,
                        'error'=>'No item to delete'
                    ]);
                }
            } else {
                return new JsonResponse([
                    'status' => 500,
                    'error' => 'Cart is empty'
                ]);
            }
        } else {
            return new JsonResponse([
                'status'=>500,
                'error'=>'Wrong method'
            ]);
        }
    }

}
