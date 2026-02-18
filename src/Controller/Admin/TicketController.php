<?php

namespace App\Controller\Admin;

use App\Entity\Ticket;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

//L’URL réelle  dépend uniquement des routes (classe + méthode), jamais du chemin Twig.
//Exemple :Route de classe : /admin/ticket ;Route de méthode : / =>URL finale : /admin/ticket/
//Et c’est cette URL qui affiche le template index.html.twig.


#[Route('/admin/ticket')]
// Toutes les routes de ce controleur commenceront par /admin/ticket c'est ce qui est appelé une route de classe; 
//c'est un préfixe pour toutes les routes de ce contrôleur

#[IsGranted('ROLE_ADMIN')] 
// controller sécurisé pour les admins uniquement

final class TicketController extends AbstractController
{
    #[Route('/', name: 'admin_ticket_index', methods: ['GET'])]
    // Cette annotation ajoute un chemin relatif : / +un nom de route : admin_ticket_index + une méthode HTTP : GET
    // C’est la route de la méthode.
    public function index(TicketRepository $ticketRepository): Response
    {
        return $this->render('admin/ticket/index.html.twig', [
            // Le chemin du template est relatif au dossier templates : admin/ticket/index.html.twig, c'est un chemin interne à Symfony, pas un chemin d'URL
            //Symfony :Va chercher le fichier Twig correspondant dans templates/ Le compile l’affiche dans le navigateur à l’URL de ta route, pas à l’URL du fichier Twig
            'tickets' => $ticketRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_ticket_new', methods: ['GET', 'POST'])]// /admin/ticket + /new
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ticket);
            $entityManager->flush();

            return $this->redirectToRoute('admin_ticket_index');
        }

        return $this->render('admin/ticket/new.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_ticket_show', methods: ['GET'])]
    // URL finale : /admin/ticket/{id}
    // (préfixe défini sur la classe + route locale)
    //  affiche un ticket en particulier
    public function show(Ticket $ticket): Response
    // Symfony va automatiquement chercher l'objet ticket correspondant à l’id dans la base de données grâce au param converter
    // Le param converter est un composant de Symfony qui permet de convertir automatiquement les paramètres d'une requête HTTP en objets PHP.
    // Par exemple, /admin/ticket/12, 1)Il voit que la route contient {id} 2)Il voit que ton argument est un objet Ticket 
    //3)Il comprend : “Je dois aller chercher le Ticket dont l’id = 12” 4)$ticket = $ticketRepository->find(12);
    //5)Il injecte l’objet dans ton contrôleur Résultat :Tu reçois directement un objet Ticket complet, pas un id.
    //C’est le ParamConverter Doctrine.le param converter peut automatiquement récupérer l'entité correspondante à partir de la base de données et la passer à votre contrôleur.
    
    {
        return $this->render('admin/ticket/show.html.twig', [
            // chemin du templates : admin/ticket/show.html.twig
            'ticket' => $ticket,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_ticket_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ticket $ticket, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_ticket_index');
        }

        return $this->render('admin/ticket/edit.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_ticket_delete', methods: ['POST'])]
    public function delete(Request $request, Ticket $ticket, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ticket->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ticket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_ticket_index');
    }
}
