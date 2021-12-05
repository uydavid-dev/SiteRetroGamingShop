<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Blogpost;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @codeCoverageIgnore
 */
class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        // Utilisation de faker
        $faker = Factory::create('fr_FR');

        // Creation d'un utilisateur
        $user = new User();


        $user->setEmail('user@test.com')
             ->setPrenom($faker->firstName())
             ->setNom($faker->lastName())
             ->setTelephone($faker->phoneNumber())
             ->setAPropos($faker->text())
             ->setRoles(['ROLE_VENDEUR']);

        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);


        $user = new User();


        $user->setEmail('david@test.com')
             ->setPrenom('david')
             ->setNom('admin')
             ->setTelephone(0102040506)
             ->setAPropos($faker->text())
             ->setRoles(['ROLE_USER']);

        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);

        $manager->persist($user);

        // Creation de 10 Blogpost
        for ($i=0; $i < 10; $i++) {
            $blogpost = new Blogpost();

            $blogpost->setTitre($faker->words(3, true))
                     ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                     ->setContenu($faker->text(350))
                     ->setSlug($faker->slug(3))
                     ->setUser($user);

            $manager->persist($blogpost);
        }

        //creation d'un blogpost

        $blogpost = new Blogpost();

        $blogpost->setTitre('Blogpost test')
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                ->setContenu($faker->text(350))
                ->setSlug('blogpost-test')
                ->setUser($user);

            $manager->persist($blogpost);

        // Creation de 5 Catégories
        for ($k=0; $k < 5; $k++) {
            $categorie = new Categorie();

            $categorie->setNom($faker->word())
                     ->setDescription($faker->words(10, true))
                     ->setSlug($faker->slug());

            $manager->persist($categorie);

            //Creation de 2 Produits/categoris
            for ($j=0; $j < 2; $j++) {
                $produit = new Produit();
    
                $produit->setNom($faker->words(3, true))
                         ->setEnVente($faker->randomElement([true, false]))
                         ->setDateRealisation($faker->dateTimeBetween('-6 month', 'now'))
                         ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                         ->setDescription($faker->text())
                         ->setPortfolio($faker->randomElement([true, false]))
                         ->setSlug('peinture-test1')
                         ->setFile('placeholder.jpg')
                         ->addCategorie($categorie)
                         ->setPrix($faker->randomFloat(2, 100, 9999))
                         ->setUser($user);
    
                $manager->persist($produit);
            }
        }

        $categorie = new Categorie();

            $categorie->setNom('categorie test')
                     ->setDescription($faker->words(10, true))
                     ->setSlug('categorie-test');

        $manager->persist($categorie);

        $produit = new Produit();
    
                $produit->setNom($faker->words(3, true))
                         ->setEnVente($faker->randomElement([true, false]))
                         ->setDateRealisation($faker->dateTimeBetween('-6 month', 'now'))
                         ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                         ->setDescription($faker->text())
                         ->setPortfolio($faker->randomElement([true, false]))
                         ->setSlug('peinture-test')
                         ->setFile('placeholder.jpg')
                         ->addCategorie($categorie)
                         ->setPrix($faker->randomFloat(2, 100, 9999))
                         ->setUser($user);
    
                $manager->persist($produit);

        $manager->flush();
    }
}
