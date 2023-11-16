<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\OrdinateurPortable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserOrdinateurPortableFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        // 1. Obtenir tous les OrdinteursPortables
        $repOrdinateursPortables = $manager->getRepository(OrdinateurPortable::class);
        $arrayObjOrdinateursPortables = $repOrdinateursPortables->findAll();

        // 2. Obtenir tous les Users
        $repUsers = $manager->getRepository(User::class);
        $arrayObjUsers = $repUsers->findAll();

        // 3. Parcourir tous les OrdinateursPortables. Pour chaque ordi, rajouter (add) un User aléatoire
        /** @var OrdinateurPortable $ordiPortable */
        foreach ($arrayObjOrdinateursPortables as $ordiPortable) {
            $randomIndex = mt_rand(0, count($arrayObjUsers) - 1); // l'index d'un ordinateur portable, random
            $ordiPortable->setUser($arrayObjUsers[$randomIndex]);
            $manager->persist($ordiPortable);
        }
        $manager->flush();
    }

    // fixer les dépéndances de cette fixture
    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            OrdinateurPortableFixtures::class
        ];
    }
}