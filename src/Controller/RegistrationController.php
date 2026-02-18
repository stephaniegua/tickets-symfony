<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{      //La rooute est la règle interne qui dit à symfony quoi faire quand on visite cette URL
       //Symfony crée automatiquement :une URL : /register
       //un nom de route : app_register
       //Ensuite, dans le code, je n’utilise jamais l’URL directement, mais le nom de la route 
       //Pourquoi ? Parce que si un jour jr change l’URL :#[Route('/inscription', name: 'app_register')]
       //Toutes tes redirections continuent de fonctionner, car elles utilisent le nom app_register, pas l’URL.
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, //Le Request est un objet qui contient toutes les informations de la requête HTTP, comme les données du formulaire.
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em //L’EntityManager est un service de Doctrine qui permet de gérer les entités, c’est-à-dire les objets qui représentent les données de la base de données. Il permet de faire des opérations comme persister (enregistrer) ou flush (valider) les données.
    ): Response { //La méthode renvoie une page (Response) qui peut être un formulaire ou une redirection.
        $user = new User();//On crée un objet user vide, qui va être rempli par le formulaire. C’est une bonne pratique de créer l’objet avant de créer le formulaire, car cela permet d’avoir un objet à manipuler même si le formulaire n’est pas encore soumis.

        $form = $this->createForm(RegistrationFormType::class, $user);
        //Symfony créé un formulaire à partir de la classe RegistrationFormType, qui définit les champs du formulaire. Le deuxième argument $user permet de lier le formulaire à l’objet user, c’est-à-dire que les données du formulaire seront automatiquement remplies dans l’objet user.
        $form->handleRequest($request);
        //handleRequest() remplit $user avec les données du formulaire si celui-ci a été soumis. Si le formulaire n’a pas été soumis, $user reste vide.

        if ($form->isSubmitted() && $form->isValid()) {
            //On vérifie le formulaire : isSubmitted() vérifie que le formulaire a été soumis, et isValid() vérifie que les données sont valides (par exemple, que l’email est au bon format, que le mot de passe n’est pas vide, etc.). Si le formulaire est valide, on peut continuer à traiter les données.

            // Hash du mot de passe car on ne stocke jamais les mots de passe en clair dans la base de données, pour des raisons de sécurité. Le passwordHasher prend le mot de passe en clair et le transforme en une chaîne de caractères sécurisée qui peut être stockée dans la base de données.
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );
            $user->setPassword($hashedPassword);//On met le mot de passe hashé dans l’objet user.

            // Rôle par défaut
            $user->setRoles(['ROLE_USER']);

            $em->persist($user);//persist() prépare l’objet user à être enregistré dans la base de données, mais ne fait pas encore l’opération. C’est comme dire à Doctrine : "Je veux enregistrer cet objet, garde-le en mémoire pour l’instant."
            $em->flush();//flush() effectue l’opération d’enregistrement dans la base de données. C’est à ce moment que les données sont réellement écrites dans la base de données.

            return $this->redirectToRoute('app_login');
        }
        // Affichage du formulaire ,c’est toujours le contrôleur qui décide quel template afficher, jamais l’URL.
        // L’affichage est défini par le template
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

