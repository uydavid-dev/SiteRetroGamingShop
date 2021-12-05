<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PortfolioController extends AbstractController
{
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/portfolio/{slug}", name="portfolio_categorie")
     */
    public function categorie(Categorie $categorie, ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findAllPortfolio($categorie);

        return $this->render('portfolio/categorie.html.twig', [
            'categorie' => $categorie,
            'produits' => $produits,
        ]);
    }
}
