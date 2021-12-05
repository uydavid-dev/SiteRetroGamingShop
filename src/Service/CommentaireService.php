<?php

namespace App\Service;

use DateTime;
use App\Entity\Contact;
use App\Entity\Produit;
use App\Entity\Blogpost;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CommentaireService
{
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flash)
    {
        $this->manager = $manager;
        $this->flash = $flash;
    }

    public function persistCommentaire(
        Commentaire $commentaire,
        Blogpost $blogpost = null,
        Produit $produit = null
    ): void {
        $commentaire->setIsPublished(false)
                    ->setBlogpost($blogpost)
                    ->setProduit($produit)
                    ->setCreatedAt(new Datetime('now'));

        $this->manager->persist($commentaire);
        $this->manager->flush();
        $this->flash->add('success', 'Votre commentaire est bien envoyé, il sera publié apres validation');
    }

}
