<?php

namespace App\Tests;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\User;
use DateTime;
use PHPUnit\Framework\TestCase;

class ProduitUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $produit = new Produit();
        $datetime = new Datetime();
        $categorie = new Categorie();
        $user = new User();

        $produit->setNom('nom')
                ->setEnVente(true)
                ->setDateRealisation($datetime)
                ->setCreatedAt($datetime)
                ->setDescription('description')
                ->setPortfolio(true)
                ->setSlug('slug')
                ->setFile('file')
                ->addCategorie($categorie)
                ->setPrix(20.20)
                ->setUser($user);
        
        $this->assertTrue($produit->getNom() === 'nom');
        $this->assertTrue($produit->getEnVente() === true);
        $this->assertTrue($produit->getDateRealisation() === $datetime);
        $this->assertTrue($produit->getCreatedAt() === $datetime);
        $this->assertTrue($produit->getDescription() === 'description');
        $this->assertTrue($produit->getPortfolio() === true); 
        $this->assertTrue($produit->getSlug() === 'slug'); 
        $this->assertTrue($produit->getFile() === 'file'); 
        $this->assertTrue($produit->getPrix() == 20.20); 
        $this->assertContains($categorie, $produit->getCategorie()); 
        $this->assertTrue($produit->getUser() === $user);        

    }

    public function testIsFalse()
    {
        $produit = new Produit();
        $datetime = new Datetime();
        $categorie = new Categorie();
        $user = new User();

        $produit->setNom('nom')
                ->setEnVente(true)
                ->setdateRealisation($datetime)
                ->setCreatedAt($datetime)
                ->setDescription('description')
                ->setPortfolio(true)
                ->setSlug('slug')
                ->setFile('file')
                ->addCategorie($categorie)
                ->setPrix(20.20)
                ->setUser($user);
        
        $this->assertFalse($produit->getNOM() === 'false');
        $this->assertFalse($produit->getEnVente() === false);
        $this->assertFalse($produit->getDateRealisation() === new Datetime);
        $this->assertFalse($produit->getCreatedAt() === new Datetime);
        $this->assertFalse($produit->getDescription() === 'false');
        $this->assertFalse($produit->getPortfolio() === false); 
        $this->assertFalse($produit->getSlug() === 'false'); 
        $this->assertFalse($produit->getFile() === 'false'); 
        $this->assertFalse($produit->getPrix() == 28.20); 
        $this->assertNotContains(new Categorie(), $produit->getCategorie()); 
        

    }

    public function testIsEmpty()
    {
        $produit = new Produit();

        $this->assertEmpty($produit->getNom());
        $this->assertEmpty($produit->getEnVente());
        $this->assertEmpty($produit->getDateRealisation());
        $this->assertEmpty($produit->getCreatedAt());
        $this->assertEmpty($produit->getDescription());
        $this->assertEmpty($produit->getPortfolio());
        $this->assertEmpty($produit->getSlug());
        $this->assertEmpty($produit->getFile()); 
        $this->assertEmpty($produit->getPrix());
        $this->assertEmpty($produit->getCategorie());
        $this->assertEmpty($produit->getUser());
              
    }
}

