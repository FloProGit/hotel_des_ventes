<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Stripe\Checkout\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Stripe\Stripe;


class PaymentController extends AbstractController
{

    public function TransformProduct(Product $product,int $quantity)
    {
        return  ['price_data'=>[
            'currency'=>'eur',
            'product_data'=>[
                'name'=>$product->getName(),
            ],
            'unit_amount'=>$product->getPriceExclTaxe()*100
        ],
             'quantity'=>$quantity,
        ];
    }

    public function getPayment(ManagerRegistry  $doctrine)
    {
        Stripe::setApiKey($_ENV['STRIPE_KEY']);

        $user = $this->getUser();
        $currentCart = $user->getCart();

        $entityManager = $doctrine->getManager();

        $userRep = $entityManager->getRepository(Product::class);
        $idsProduct = [];
        foreach ($currentCart as $key => $value)
        {
            $idsProduct[] = $key;
        }

        $products = $userRep->getAllIn($idsProduct);
        $testArray = [];
        foreach ($products as $product)
        {
            $testArray[] =  $this->TransformProduct($product,$currentCart[$product->getId()]);
        }



        $session = Session::create([
            'line_items'=>$testArray,
            'mode'=>'payment',
            'success_url'=> 'http://127.0.0.1:8000/checkout_success',
            'cancel_url'=> 'http://127.0.0.1:8000/checkout_error',
        ]);
        return $this->redirect($session->url,303);
    }

}

