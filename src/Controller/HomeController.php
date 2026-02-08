<?php

// src/Controller/HomeController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function accueil(): Response
    {
        return new Response(
            '<html><body><h1>Welcome to the Home Page!</h1></body></html>'
        );
    }
}