<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use Symfony\Component\HttpFoundation\Request;   
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class TicketController extends AbstractController
{
    #[Route('/ticket/new', name: 'ticket_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
    $ticket = new Ticket(); 
    $ticket->setCreatedAt(new \DateTimeImmutable()); 
    $ticket->setStatus('open'); 

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