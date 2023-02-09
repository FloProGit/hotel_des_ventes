<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public  function __construct(private readonly ProductRepository $productRepository)
    {
    }

    public function show(Request $request, ProductRepository $repository): Response
    {
        $productId = str_replace('/product/', '', $request->getPathInfo());
        $product = $repository->find($productId);
        return $this->render('show-product.html.twig', ['product' => $product]);
    }

    public function showList(Request $request, ProductRepository $repository): Response
    {
        $products = $repository->findAll();
        return $this->render('list-product.html.twig', ['products' => $products]);
    }

    public function create(Request $request): Response
    {

        if ($request->isMethod('post')) {
            $this->AddProduct($request);
            return  $this->redirectToRoute('home_page');
        }

        return $this->render('create-product.html.twig');
    }

    public function update(Request $request): Response
    {
        return $this->render('base.html.twig');
    }


    private function AddProduct(Request $request)
    {
        try {
            $currentProduct = new Product();
            $currentProduct->setName($request->get('name-product'));
            $currentProduct->setDescription($request->get('description-product'));
            $currentProduct->setPriceExclTaxe($request->get('prix-product'));
            $currentProduct->setBarCode(random_int(0, 1000));
            $this->productRepository->save($currentProduct, true);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
