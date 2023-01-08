<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    //ajouter stagiaire
    #[Route('/stagiaire/add', name: 'add_stagiaire')]
    public function add(ManagerRegistry $doctrine, Stagiaire $stagiaire = null, Request $request)
    {
        $stagiaire = new Stagiaire;
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // recuperer les données de stagiaire si il existe deja et si il est nul
            $stagiaire = $form->getData();
           
            // on recupere le managere doctrine
            $entityManager = $doctrine->getManager();


            // persist remplace prepare en pdo , on prepare l'objet stagiaire
            $entityManager->persist($stagiaire);

            //on execute 
            $entityManager->flush();


            // on  retourne vers la page affichage de tous les employés
            return $this->redirectToRoute('app_stagiaire');
        }
        return $this->render('stagiaire/add.html.twig', [
            'formAddStagiaire' => $form->createView(),
        ]);
    }
    // afficher detail d'un stagiaire 
    #[Route('/stagiaire/{id}', name: 'show_stagiaire')]
    public function show(Stagiaire $stagiaire): Response
    {
        return $this->render('stagiaire/show.html.twig', [
            'stagiaire' => $stagiaire,
        ]);
    }

    // afficher liste des stagiaires
    #[Route('/stagiaire', name: 'app_stagiaire')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $stagiaires = $doctrine->getRepository(Stagiaire::class)->findAll();
        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires,
        ]);
    }
}
