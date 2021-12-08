<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Service\CommentaireService;
use App\Repository\ProduitRepository;
use App\Repository\CommentaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/collections", name="collections")
     */
    public function collections(
        ProduitRepository $produitRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $produitRepository->findBy([], ['id' => 'DESC']);

        $produits = $paginator->paginate(
            $data, /* query Not result */
            $request->query->getInt('page', 1), /*page number*/
            6
        );
    
        return $this->render('produit/collections.html.twig', [
            'produits' => $produits,
        ]);
    }

    /**
     * @Route("/collections/{slug}", name="collections_details")
     */
    public function details(
        Produit $produit,
        Request $request,
        CommentaireService $commentaireService,
        CommentaireRepository $commentaireRepository
    ): Response {
        $commentaires = $commentaireRepository->findCommentaires($produit);
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, null, $produit);

            return $this->redirectToRoute('collections_details', ['slug' => $produit->getSlug()]);
        }
        return $this->render('produit/details.html.twig', [
            'produit'       => $produit,
            'form'          => $form->createView(),
            'commentaires'  => $commentaires
        ]);
    }
}
