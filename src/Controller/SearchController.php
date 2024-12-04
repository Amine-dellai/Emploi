<?php 
// src/Controller/SearchController.php

namespace App\Controller;

use App\Entity\EmploiDuTemps;
use App\Repository\EmploiDuTempsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/recherche', name: 'emploi_du_temps_recherche')]
    public function search(Request $request, EmploiDuTempsRepository $repository): Response
    {
        // Initialize the query parameters for searching
        $day = $request->query->get('jour');
        $title = $request->query->get('titre');

        // Build the query based on search criteria
        $queryBuilder = $repository->createQueryBuilder('e');

        if ($day) {
            $queryBuilder->andWhere('e.jour = :jour')
                         ->setParameter('jour', $day);
        }

        if ($title) {
            $queryBuilder->andWhere('e.titre LIKE :titre')
                         ->setParameter('titre', '%' . $title . '%');
        }

        $emplois = $queryBuilder->getQuery()->getResult();

        return $this->render('emploi_du_temps/recherche.html.twig', [
            'emplois' => $emplois,
        ]);
    }
}
