<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomePageController extends AbstractController
{
    public function show(ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        $products = array_slice($products, 0, 10);
        return $this->render('home.html.twig', ['products' => $products]);
    }
}
