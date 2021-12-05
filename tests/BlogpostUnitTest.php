<?php

namespace App\Tests;

use DateTime;
use App\Entity\Blogpost;
use App\Entity\Commentaire;
use PHPUnit\Framework\TestCase;

class BlogpostUnitTest extends TestCase
{
    public function testIsTrue()
    {
        $Blogpost = new Blogpost();
        $datetime = new Datetime();

        $Blogpost->setTitre('titre')
                  ->setCreatedAt($datetime)
                  ->setContenu('contenu')
                  ->setSlug('slug');
        
        $this->assertTrue($Blogpost->getTitre() === 'titre');
        $this->assertTrue($Blogpost->getCreatedAt() === $datetime);
        $this->assertTrue($Blogpost->getContenu() === 'contenu');
        $this->assertTrue($Blogpost->getSlug() === 'slug');       

    }

    public function testIsFalse()
    {
        $Blogpost = new Blogpost();
        $datetime = new Datetime();

        $Blogpost->setTitre('Titre')
                 ->setCreatedAt($datetime)
                 ->setContenu('contenu')
                 ->setSlug('slug');
        
        $this->assertFalse($Blogpost->getTitre() === 'false');
        $this->assertFalse($Blogpost->getCreatedAt() === new datetime());
        $this->assertFalse($Blogpost->getContenu() === 'false');
        $this->assertFalse($Blogpost->getSlug() === 'false');       
    }

    public function testIsEmpty()
    {
        $Blogpost = new Blogpost();

        $this->assertEmpty($Blogpost->getTitre());
        $this->assertEmpty($Blogpost->getCreatedAt());
        $this->assertEmpty($Blogpost->getContenu());
        $this->assertEmpty($Blogpost->getSlug()); 
        $this->assertEmpty($Blogpost->getId()); 
    }
  
}