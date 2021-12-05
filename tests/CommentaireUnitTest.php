<?php

namespace App\Tests;

use App\Entity\Produit;
use App\Entity\Blogpost;
use App\Entity\Commentaire;
use DateTime;
use PHPUnit\Framework\TestCase;

class CommentaireUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $commentaire = new Commentaire();
        $produit = new Produit();
        $datetime = new Datetime();
        $blogpost = new Blogpost();

        $commentaire->setAuteur('auteur')
                    ->setEmail('test@test.com')
                    ->setCreatedAt($datetime)
                    ->setContenu('contenu')
                    ->setBlogpost($blogpost)
                    ->setProduit($produit);
        
        $this->assertTrue($commentaire->getAuteur() === 'auteur');
        $this->assertTrue($commentaire->getEmail() === 'test@test.com');
        $this->assertTrue($commentaire->getCreatedAt() === $datetime);
        $this->assertTrue($commentaire->getContenu() === 'contenu');
        $this->assertTrue($commentaire->getBlogpost() === $blogpost);
        $this->assertTrue($commentaire->getProduit() === $produit);       

    }

    public function testIsFalse()
    {
        $commentaire = new Commentaire();
        $produit = new Produit();
        $datetime = new Datetime();
        $blogpost = new Blogpost();

        $commentaire->setAuteur('auteur')
                    ->setEmail('test@test.com')
                    ->setCreatedAt($datetime)
                    ->setContenu('contenu')
                    ->setBlogpost($blogpost)
                    ->setProduit($produit);
        
        $this->assertFalse($commentaire->getAuteur() === 'false');
        $this->assertFalse($commentaire->getEmail() === 'false@test.com');
        $this->assertFalse($commentaire->getCreatedAt() === new datetime);
        $this->assertFalse($commentaire->getContenu() === 'nocontenu');
        $this->assertFalse($commentaire->getBlogpost() === new blogpost);
        $this->assertFalse($commentaire->getProduit() === new produit);      
    }

    public function testIsEmpty()
    {
        $commentaire = new Commentaire();

        $this->assertEmpty($commentaire->getAuteur());
        $this->assertEmpty($commentaire->getEmail());
        $this->assertEmpty($commentaire->getCreatedAt());
        $this->assertEmpty($commentaire->getContenu());
        $this->assertEmpty($commentaire->getBlogpost());  
        $this->assertEmpty($commentaire->getProduit());      
    }
}

