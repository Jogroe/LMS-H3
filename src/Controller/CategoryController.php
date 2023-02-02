<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepo){

    }

    #[Route('/categories', name: 'categories')]
    public function index(): Response
    {
        $categories = $this->categoryRepo->getCategoriesName();
        
        return $this->render('category/index.html.twig', ['categories' => $categories]);
    }

    // #[Route('/category/{slug}', name: 'category.products')]
    // public function categoryProducts(string $slug): Response
    // {
    //     $categoryProducts = $this->categoryRepo->getProductsByCategory($slug);
    //     return $this->render('category/products.html.twig', ['products' => $categoryProducts]);
    // }
}