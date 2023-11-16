<?php

namespace App\DataFixtures;

use App\Entity\OrdinateurPortable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
;

class OrdinateurPortableFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        
        $marque= array('Asus','Dell','Fujitsu', 'HP', 'Lenovo', 'Microsoft');
        $processeur= array('Core i3','Core i5','Core i7','Core i9','AMD','Ryzen 3','Ryzen 5','Intel Xeon');
        $systemeExploitation = array('Windows 11 Pro','Linux');

        
        for ($i = 0; $i <= 15; $i++) {

            $op = new OrdinateurPortable();
            // si on a un hydrate, pas besoin de sets...
            //TODO update foreach images
            //TODO uuid pour la référence
            $op->setReference("op" . $i);
            $op->setImage("/images/image".$i+1 .".jpg");
            // $op->setNom($marque[mt_rand(0, count($marque) - 1)] . $i);
            $op->setNom("Ordi" . $i);
            $op->setMarque($marque[mt_rand(0, count($marque) - 1)]);
            // $op->setPrix(mt_rand(300.00, 900.00));
            $op->setPrix(mt_rand(300.00, 1500.00));
            $op->setProcesseur($processeur[mt_rand(0, count($processeur) - 1)]);
            $op->setSystemeExploitation($systemeExploitation[mt_rand(0, count($systemeExploitation) - 1)]);
            $op->setCommentaire("");
            $manager->persist($op);

        }
        
        $manager->flush();
    }
}

