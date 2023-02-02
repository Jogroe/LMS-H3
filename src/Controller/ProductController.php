<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(private ProductRepository $productRepo){

    }

    #[Route('/product/{slug}', name: 'product.detail')]
    public function detail(string $slug): Response
    {
        $product = $this->productRepo->findOneBy(['slug' => $slug]);
        return $this->render('product/detail.html.twig', ['product' => $product]);
    }

    #[Route('/products/page/{page}', name: 'products')]
    public function index(int $page = 1): Response
    {
        $products = $this->productRepo->getProductPerPage(($page - 1) * 12);
        $countProduct = $this->productRepo->countProduct();
        return $this->render('product/index.html.twig', ['products' => $products, 'page' => $page]);
    }
}