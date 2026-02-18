<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TechStatusType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/tech')]
#[IsGranted('ROLE_TECH')]
final class TechController extends AbstractController
{
    #[Route('/', name: 'tech_dashboard')]
    public function index(): Response
    {
        return $this->render('tech/index.html.twig');
    }
    #[Route('/tickets', name: 'tech_ticket_index')]
    public function tickets(TicketRepository $ticketRepository): Response
    {
        return $this->render('tech/tickets.html.twig', [
            'tickets' => $ticketRepository->findAll(),
        ]);
    }

    #[Route('/ticket/{id}', name: 'tech_ticket_show')]
    public function show(Ticket $ticket): Response
    {
        return $this->render('tech/show.html.twig', [
            'ticket' => $ticket,
        ]);
    }

    #[Route('/ticket/{id}/edit-status', name: 'tech_ticket_edit_status')]
    public function editStatus(Request $request, Ticket $ticket, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(TechStatusType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('tech_ticket_show', ['id' => $ticket->getId()]);
        }

        return $this->render('tech/edit_status.html.twig', [
            'ticket' => $ticket,
            'form' => $form,
        ]);
    }
}

