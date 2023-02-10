<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutErrorController extends AbstractController
{
    #[Route('/checkout_error', name: 'app_checkout_error')]
    public function index(): Response
    {
        return $this->render('checkout_error/index.html.twig', [
            'controller_name' => 'CheckoutErrorController',
        ]);
    }
}
