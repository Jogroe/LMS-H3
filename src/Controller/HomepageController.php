<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->randomProducts();
        return $this->render('index.html.twig', ['products' => $products]);
    }
}