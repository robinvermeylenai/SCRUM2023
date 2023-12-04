<?php

declare(strict_types=1);
namespace Business;

use Business\ArticleService;
use Business\OrderDetailService;

class CartService
{
    public function addToCart(array $cartArray, int $artId) : array
    {
        $artServ = new ArticleService();
        $orDetServ = new OrderDetailService();
        $article = $artServ->getArticle((int)$artId);
        if(!(is_null($article))) {//article/id exists in database so can be added as an OrderDetail to cart session
        //check that stock has not been depleted in meantime
            if(($article->getStock()!=0))
            {
                $alreadyInCart = false;
                //go through cartArray to see if article is already in there. If so, +1
                foreach($cartArray as $cart)
                {
                    if($cart->getArticleId() == $artId)
                    {
                        $cart->setQuantityOrdered((int)$cart->getQuantityOrdered()+1);
                        $alreadyInCart = true;
                    }
                }
                if(!($alreadyInCart))//not found in cart, so let's add it
                {
                    $orderDetail = $orDetServ->getOrderDetailForCart((int)$artId,1);
                    array_push($cartArray,$orderDetail);
                }
            } else {
                /// TO DO: error handling in case stock has been depleted after clicking 'buy'
            }
        } else {
            /// TO DO: error handling in case artId does not exist (most likely error on our end then)
        }
        return $cartArray;
    }

    public function removeFromCart(array $cartArray, int $artId) : array
    {
        //filtering array to only keep OrderDetails that do not match the articleId that needs to be deleted
        $cartArray = array_filter($cartArray, function($od) use ($artId){
            return $od->getArticleId() != $artId;
        });
        //array_values to re-index array (remove index gaps)
        $cartArray = array_values($cartArray);
        return $cartArray;
    }

    public function modifyQuantity(array $cartArray, int $artId, int $by) : array
    {
        foreach($cartArray as $cart)
        {
            //go through cart to find article to adjust quantity
            if($cart->getArticleId() == $artId) {
                $cart->setQuantityOrdered($cart->getQuantityOrdered() + $by);
            }
        }
        
        //check that articles in cart still have quantity > 0, otherwise remove 0-articles
        $cartArray = array_filter($cartArray, function($od) {
            return $od->getQuantityOrdered() != 0;
        });
        //array_values to re-index array (remove index gaps)
        $cartArray = array_values($cartArray);

        //check stock and set # in winkelmand to max stock
        /*array_map(function($od) {
            $artServ = new ArticleService();
            $article = $artServ->getArticle((int)$od->getArticleId());
            if($article->getStock() < $od->getQuantityOrdered())
            {
                //higher quantity in cart than is available; adjust quantityOrdered to max stock currently available
                $od->setQuantityOrdered((int)$article->getStock());
            }
        }, $cartArray); */
        return $cartArray;
    }

    public function createCartArticles(array $cartArray) : array
    {
        $artServ = new ArticleService();
        $cartArticleList = array();
        foreach($cartArray as $cart)
        {
            $article = $artServ->getArticle((int)$cart->getArticleId());
            $cartArticleList[$cart->getArticleId()] = $article;
        }
        return $cartArticleList;
    }

    public function calculateTotalCartPrice(array $cartArray, array $artArray) : float
    {
        $total = 0;
        foreach($cartArray as $cart) {
            $total = $total + ($artArray[$cart->getArticleId()]->getPriceInclusive() * $cart->getQuantityOrdered());
        }
        return $total;
    }

    public function calculateTotalCartPriceNoBtw(array $cartArray, array $artArray) : float
    {
        $total = 0;
        foreach($cartArray as $cart) {
            $total = $total + ($artArray[$cart->getArticleId()]->getPrice() * $cart->getQuantityOrdered());
        }
        return $total;
    }
}