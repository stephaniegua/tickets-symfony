<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/tickets')]
class AdminTicketController extends AbstractController
{
    #[Route('/', name: 'admin_ticket_index')]
    public function index(): Response
    {
        return $this->render('admin/ticket/index.html.twig');
    }
}
