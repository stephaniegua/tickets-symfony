<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;   
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\StatutRepository;    


final class TicketController extends AbstractController
{
    #[Route('/ticket/new', name: 'ticket_new')]
    public function __construct(
        private StatutRepository $statutRepository
        ) {}
    public function new(Request $request, EntityManagerInterface $em): Response
    {
    $ticket = new Ticket(); 
    $ticket->setCreatedAt(new \DateTimeImmutable()); 

    // Récupérer le statut "Ouvert" depuis la base de données
    //Quand tu injectes un repository dans le constructeur, tu dois l'utiliser via $this->statutRepository.
    $statut = $this->statutRepository->findOneBy(['nom' => 'Ouvert']);
    $ticket->setStatut($statut);


    $form = $this->createForm(TicketType::class, $ticket); 
    $form->handleRequest($request); 

    if ($form->isSubmitted() && $form->isValid()) { 
        $em->persist($ticket); 
        $em->flush(); 

        return $this->redirectToRoute('home'); 
    } 

    return $this->render('ticket/new.html.twig', [ 
        'form' => $form->createView(),
         ]); 
}
         
}