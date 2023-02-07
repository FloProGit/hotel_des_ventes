<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class ProductController extends AbstractController
{

    public function show(Request $request) :Response
    {
        return $this->render('base.html.twig');
    }

    public function showList(Request $request) :Response
    {
        return $this->render('base.html.twig');
    }

    public function create(Request $request) :Response
    {
        return $this->render('base.html.twig');
    }

    public function update(Request $request) :Response
    {
        return $this->render('base.html.twig');
    }
}
