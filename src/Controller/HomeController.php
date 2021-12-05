<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProduitRepository $produitRepository, BlogpostRepository $blogpostRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'produits' => $produitRepository->lastTree(),
            'blogposts' => $blogpostRepository->lastTree(),
        ]);
    }
}
