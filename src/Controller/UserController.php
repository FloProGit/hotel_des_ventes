<?php

namespace App\Controller;



use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{

    public function addProductToCart(Request $request,ManagerRegistry  $doctrine):Response
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }

        $productId = str_replace('/products/add_to_cart/', '', $request->getPathInfo());

         $user = $this->getUser();
        $currentCart = $user->getCart();

        $entityManager = $doctrine->getManager();
        $userRep = $entityManager->getRepository(User::class)->find(1);

         if(array_key_exists($productId,$currentCart))
         {
             $currentCart[$productId] = (intval($currentCart[$productId]))+1;
         }
         else
         {
             $currentCart[$productId] = 1;
         }

        $userRep->setCart($currentCart);

        $entityManager->flush();

        return $this->redirectToRoute('product_id',["id"=>$productId]);

    }

    public function removeProductToCart(Request $request,ManagerRegistry  $doctrine):Response
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }

        $productId = str_replace('/products/remove_to_cart/', '', $request->getPathInfo());

        $user = $this->getUser();
        $currentCart = $user->getCart();

        $entityManager = $doctrine->getManager();
        $userRep = $entityManager->getRepository(User::class)->find(1);

        if(array_key_exists($productId,$currentCart))
        {

            $currentCart = array_filter($currentCart, fn($key) => !in_array($key, [$productId]), ARRAY_FILTER_USE_KEY);

        }

        $userRep->setCart($currentCart);

        $entityManager->flush();

        return $this->redirect($request->getReferer());

    }
}