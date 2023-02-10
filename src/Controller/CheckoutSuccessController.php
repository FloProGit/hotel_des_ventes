<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutSuccessController extends AbstractController
{
    #[Route('/checkout_success/{token}', name: 'app_checkout_success')]
    public function index(Request $request): Response
    {
        $token = $request->get('token');
        if($this->isCsrfTokenValid('stripe_token',$token)){
            $user = $this->getUser();
            $order = New Order();
            dd('csrf_ok');
        }
        return $this->render('checkout_success/index.html.twig', [
            'controller_name' => 'CheckoutSuccessController',
        ]);
    }
}
