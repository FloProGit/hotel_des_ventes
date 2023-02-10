<?php

namespace App\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    public function index()
    {


        return $this->render('cart.html.twig');

    }

}


