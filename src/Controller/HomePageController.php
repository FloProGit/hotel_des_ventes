<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomePageController extends AbstractController
{
    public function show(): Response
    {
        return $this->render('base.html.twig', ['name' => 'test', 'description' => 'testtest', 'price_excl_taxe' => '123', 'visuals' => 'https=>//picsum.photos/200/300']);
    }
}
