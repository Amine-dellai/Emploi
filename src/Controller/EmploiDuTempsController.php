<?php
// src/Controller/EmploiDuTempsController.php
namespace App\Controller;

use App\Entity\EmploiDuTemps;
use App\Form\EmploiDuTempsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmploiDuTempsController extends AbstractController
{
    #[Route('/emploi-du-temps', name: 'emploi_du_temps_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $emplois = $em->getRepository(EmploiDuTemps::class)->findAll();

        // Définition des créneaux horaires de chaque session
        $sessionsTime = [
            'Matin' => ['start' => '08:00', 'end' => '09:30'],
            'Milieu de Matinée' => ['start' => '09:30', 'end' => '11:00'],
            'Après-midi' => ['start' => '13:00', 'end' => '14:30'],
        ];

        // Jours de la semaine
        $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $schedule = [];

        foreach ($days as $day) {
            $schedule[$day] = [];

            foreach ($sessionsTime as $key => $time) {
                $session = [
                    'title' => 'Séance ' . ($key === 'Matin' ? '1' : ($key === 'Milieu de Matinée' ? '2' : '3')),
                    'start' => $time['start'],
                    'end' => $time['end'],
                    'lieu' => '',
                    'enseignant' => '',
                ];

                // Vérification des emplois qui correspondent au jour et à l'horaire
                foreach ($emplois as $emploi) {
                    if ($emploi->getJour() === $day && $emploi->getDebut()->format('H:i') === $session['start']) {
                        $session['title'] = $emploi->getTitre();
                        $session['lieu'] = $emploi->getLieu();
                        $session['enseignant'] = $emploi->getEnseignant();
                        break;
                    }
                }

                $schedule[$day][] = $session;
            }
        }

        return $this->render('emploi_du_temps/index.html.twig', [
            'schedule' => $schedule,
            'emplois' => $emplois,
        ]);
    }

    #[Route('/emploi-du-temps/nouveau', name: 'emploi_du_temps_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $emploi = new EmploiDuTemps();
        $form = $this->createForm(EmploiDuTempsType::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($emploi);
            $em->flush();

            $this->addFlash('success', 'Emploi du temps créé avec succès.');

            return $this->redirectToRoute('emploi_du_temps_index');
        }

        return $this->render('emploi_du_temps/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/emploi-du-temps/{id}/modifier', name: 'emploi_du_temps_edit')]
    public function edit(Request $request, EmploiDuTemps $emploi, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(EmploiDuTempsType::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Emploi du temps modifié avec succès.');

            return $this->redirectToRoute('emploi_du_temps_index');
        }

        return $this->render('emploi_du_temps/edit.html.twig', [
            'form' => $form->createView(),
            'emploi' => $emploi,
        ]);
    }

    #[Route('/emploi-du-temps/{id}/supprimer', name: 'emploi_du_temps_delete', methods: ['POST'])]
    public function delete(Request $request, EmploiDuTemps $emploi, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('delete' . $emploi->getId(), $request->request->get('_token'))) {
            $em->remove($emploi);
            $em->flush();

            $this->addFlash('success', 'Emploi du temps supprimé avec succès.');
        }

        return $this->redirectToRoute('emploi_du_temps_index');
    }
}
