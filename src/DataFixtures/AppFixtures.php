<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création de 5 clients
        $clientsData = [
            ['Jean Dupont', 'jean.dupont@example.com', '0601020304'],
            ['Marie Curie', 'marie.curie@example.com', '0611223344'],
            ['Albert Einstein', 'albert.einstein@example.com', '0622334455'],
            ['Isaac Newton', 'isaac.newton@example.com', '0633445566'],
            ['Ada Lovelace', 'ada.lovelace@example.com', '0644556677'],
        ];

        foreach ($clientsData as [$nom, $email, $phone]) {
            $client = new Client();
            $client->setName($nom);
            $client->setEmail($email);
            $client->setPhone($phone);
            $manager->persist($client);
        }

        // Création de 10 produits
        $produitsData = [
            ['Pommes', 2.5, 100],
            ['Bananes', 1.8, 80],
            ['Oranges', 3.0, 90],
            ['Pain', 1.2, 50],
            ['Lait', 0.9, 60],
            ['Fromage', 4.5, 40],
            ['Yaourt', 1.0, 70],
            ['Jambon', 3.7, 30],
            ['Beurre', 2.3, 25],
            ['Céréales', 3.1, 35],
        ];

        foreach ($produitsData as [$nom, $prix, $stock]) {
            $produit = new Produit();
            $produit->setName($nom);
            $produit->setPrixUnitaire($prix);
            $produit->setQuantiteStock($stock);
            $manager->persist($produit);
        }

        $manager->flush();
    }
}
