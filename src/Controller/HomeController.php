<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]  // This should be the root (/) route, not /home
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'site_name' => 'Emploi',
        ]);
    }

}

