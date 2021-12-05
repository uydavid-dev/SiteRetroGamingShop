<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AProposController extends AbstractController
{
    /**
     * @Route("/a-propos", name="a_propos")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('a_propos/index.html.twig', [
            'vendeur' => $userRepository->getVendeur(),
        ]);
    }
}

