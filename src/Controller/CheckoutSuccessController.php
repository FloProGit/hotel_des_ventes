<?php

namespace App\Controller;

use App\Entity\DeliveryCompany;
use App\Entity\Orders;
use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutSuccessController extends AbstractController
{
    #[Route('/checkout_success/{token}', name: 'app_checkout_success')]
    public function index(Request $request,ManagerRegistry  $doctrine): Response
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }

        $token = $request->get('token');
        if(!$this->isCsrfTokenValid('stripe_token',$token)){
            
            return $this->redirectToRoute('app_home');
        }
        
        $user = $this->getUser();
        if(empty($user->getCart)){
            return $this->redirectToRoute('app_home');
        }
        $currentCart = $user->getCart();
        $entityManager = $doctrine->getManager();
        
        $userRep = $entityManager->getRepository(Product::class);
        $OrdersRep =  $entityManager->getRepository(Orders::class);
        $deliveryRep= $entityManager->getRepository(DeliveryCompany::class);
        $deliverycompagny = $deliveryRep->find('1');
        // dd($deliverycompagny);
        foreach ($currentCart as $key => $value)
        {
            $idsProduct[] = $key;
        }

        $products = $userRep->getAllIn($idsProduct);
        $total = 0;
        foreach($products as $product)
        {
            $total += $product->getPriceExclTaxe();
        }
        
        $cart = $user->getCart();
        // dd($cart);
        $Orders = New Orders();
        $Orders->setEtat("payé")
              ->setContent($cart)
              ->setTotalExclTaxe($total)
              ->setShippingFee(0)
              ->setTotal(($total*1.2))
              ->setUser($user)
              ->setDeliveryCompany($deliverycompagny)
        ;
        $OrdersRep->save($Orders,true);
        $user->setCart([]);
        $entityManager->flush();
        dd($currentCart);
        return $this->render('checkout_success/index.html.twig', [
            'controller_name' => 'CheckoutSuccessController',
        ]);
    }
}
