<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketPublicType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, EntityManagerInterface $em): Response

    {    // On instancie un nouveau ticket
        $ticket = new Ticket();
        $ticket->setCreatedAt(new \DateTimeImmutable());
        
        // On crée le formulaire en lui passant l'instance du ticket
        $form = $this->createForm(TicketPublicType::class, $ticket);
        // On traite la requête du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est valide -> on enregistre le ticket en base de données
            $em->persist($ticket);
            $em->flush();

            // On ajoute un message flash de succès
            $this->addFlash('success', 'Votre ticket a bien été enregistré.');

            
            return $this->redirectToRoute('app_home');
        }

        // On affiche le formulaire dans la vue
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
