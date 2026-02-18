<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Categorie;
use App\Entity\Statut;
use App\Entity\Responsable;
use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        // --- USERS ---
        $admin = new User();
        $admin->setNom('Administrateur');
        $admin->setEmail('admin@test.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin123'));
        $manager->persist($admin);

        $tech = new User();
        $tech->setNom('Technicien');
        $tech->setEmail('tech@test.com');
        $tech->setRoles(['ROLE_TECH']);
        $tech->setPassword($this->hasher->hashPassword($tech, 'tech123'));
        $manager->persist($tech);

        $user = new User();
        $user->setNom('Utilisateur');
        $user->setEmail('user@test.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->hasher->hashPassword($user, 'user123'));
        $manager->persist($user);

        // --- CATEGORIES ---
        $cat1 = (new Categorie())->setNom('Informatique');
        $cat2 = (new Categorie())->setNom('Réseau');
        $cat3 = (new Categorie())->setNom('Matériel');

        $manager->persist($cat1);
        $manager->persist($cat2);
        $manager->persist($cat3);

        // --- STATUTS ---
        $s1 = (new Statut())->setNom('Ouvert');
        $s2 = (new Statut())->setNom('En cours');
        $s3 = (new Statut())->setNom('Résolu');

        $manager->persist($s1);
        $manager->persist($s2);
        $manager->persist($s3);

        // --- RESPONSABLES ---
        $r1 = (new Responsable())->setNom('Jean Dupont')
            ->setEmail('jean.dupont@test.com');

        $r2 = (new Responsable())->setNom('Sophie Martin')
            ->setEmail('sophie.martin@test.com');

        $manager->persist($r1);
        $manager->persist($r2);

        // --- TICKETS ---
        for ($i = 1; $i <= 5; $i++) {
            $ticket = new Ticket(); 
            $ticket->setAuteur($user);
            $ticket->setDescription("Problème numéro $i");
            $ticket->setCategorie($cat1);
            $ticket->setStatut($s1);
            $ticket->setResponsable($r1);
            $ticket->setCreatedAt(new \DateTimeImmutable());

            $manager->persist($ticket);
        }

        $manager->flush();
    }
}
