<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\SearchType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    public function __construct(private RequestStack $requestStack){

    }

    #[Route('/search', name: 'search')]
    public function index(ProductRepository $productRepository): Response
    {
        $type = SearchType::class;

        $form = $this->createForm($type);

        $form->handleRequest($this->requestStack->getCurrentRequest());
        
        if($form->isSubmitted() && $form->isValid()) {
            $name = $this->requestStack->getCurrentRequest()->get('search')['name'];
            $products = $productRepository->search($name);
            
            return $this->render('search/index.html.twig', ['form' => $form->createView(), 'products' => $products]);
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/search/result/{name}', name: 'search.result')]
    public function searchResult(ProductRepository $productRepository, string $name): Response
    {
        $products = $productRepository->search($name);

        return $this->render('search/result.html.twig', [
            'products' => $products,
        ]);
    }
}