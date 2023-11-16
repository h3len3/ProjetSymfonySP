<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setMail("user" . $i . "@gmail.com");
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                'password' . $i
            ));
            $manager->persist($user);
        }
        $manager->flush();

    // Je souhaite que UN user uniquement ait le rôle admin (rôle permettant de inscr/ajouter un employé)
    // Je fais/instancie un objet de la classe user qui a un rôle
    $admin =new User();
    $admin->setMail('boss@mail.com');
    $admin->setPassword($this->passwordHasher->hashPassword(
        $admin,
        '1234jesuisadmin' // mot de passe à changer par le patron
    ));
    $admin->setPrenom('adminPrenom');
    $admin->setNom('adminNom');

    $admin->setRoles(['ROLE_ADMIN']);

    $manager->persist($admin);  // Rappel: persist // insert into partie préparatif de ce qu'il a besoin pour maj bd

    $manager->flush();    // maj bd 
                          // On pourrait  ne le faire que une fois à la fin
                          // https://symfony.com/doc/current/doctrine.html#persisting-objects-to-the-database


    }

    

}
