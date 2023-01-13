<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Form\ProgrammeType;
use App\Repository\SessionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    // inscrire un stagiaire
    #[Route('/session/{id}/inscrire/{idStagiaire}', name: 'inscrire_stagiaire')]
    public function inscrire(int $idStagiaire, ManagerRegistry $doctrine, Stagiaire $stagiaire, Session $session): Response
    {
        $entityManager = $doctrine->getManager();
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($idStagiaire);
        $session->addStagiaire($stagiaire);
        $entityManager->flush();
        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }
    // desinscrire un stagiaire 
    #[Route('/session/{id}/desinscrire/{idStagiaire}', name: 'desinscrire_stagiaire')]
    public function desinscrire(int $idStagiaire, ManagerRegistry $doctrine, Stagiaire $stagiaire, Session $session): Response
    {
        $entityManager = $doctrine->getManager();
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($idStagiaire);
        $session->removeStagiaire($stagiaire);
        $entityManager->flush();
        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }
    //ajouter une session
    #[Route('/session/add', name: 'add_session')]
    public function add(ManagerRegistry $doctrine, Session $session = null, Request $request): Response
    {
        // construire un formulaire qui va se baser sur le $builder dans SessionType
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // recuperer les données de session si il existe deja et si il est nul
            $session = $form->getData();

            // on recupere le managere doctrine
            $entityManager = $doctrine->getManager();

            // persist remplace prepare en pdo , on prepare l'objet Employe 
            $entityManager->persist($session);

            //on execute 
            $entityManager->flush();

            // on  retourne vers la page affichage de tous les employés
            return $this->redirectToRoute('list_session');
        }
        return $this->render('session/add.html.twig', [
            'formAddSession' => $form->createView()
        ]);
    }


    // afficher detail d'un session 
    #[Route('/session/{id}', name: 'show_session')]
    public function show(ManagerRegistry $doctrine, Session $session, Programme $programme, SessionRepository $sr, Request $request): Response
    {
        $session_id = $session->getId();
        $nonProgrammer = $sr->findModules($session_id);
        $nonInscrit = $sr->findStagiaireNotInscrit($session_id);
        // formulaire pour programmer module d'une session
        $programme = new Programme();
        // construire un formulaire qui va se baser sur le $builder dans ProgrammeType
        $form = $this->createForm(ProgrammeType::class, $programme);
        $form->handleRequest($request);

        // isValid () remplace les filter input 
        if ($form->isSubmitted() && $form->isValid()) {

            // recuperer les données inserer dans le formulaire et les injecter dans l'objet entreprise grace au seter
            $programme = $form->getData();
            $programme->setSession($session);

            // on recupere le managere doctrine
            $entityManager = $doctrine->getManager();

            // persist remplace prepare en pdo , on prepare l'objet entreprise 
            $entityManager->persist($programme);

            // execute,inserer les données dans la bdd
            $entityManager->flush();

            // retourner a la page qui affiche toutes les entreprises

            return $this->redirectToRoute('list_session');
        }
        return $this->render('session/show.html.twig', [
            'session' => $session,
            'stagiairesNonInscrit' => $nonInscrit,
            'ModulesNonProgrammer' => $nonProgrammer,
            'AddProgramme' => $form->createView(),
        ]);
    }
    // pour afficher liste de sessions separer(en cours,a venir,passée)
    #[Route('/list', name: 'list_session')]
    public function list(SessionRepository $sr): Response
    {
        $pastSessions = $sr->findPastSession();
        $futurSessions = $sr->findFuturSession();
        $progressSessions = $sr->findProgressSession();
        return $this->render('session/listSessions.html.twig', [
            'pastSession' => $pastSessions,
            'futurSession' => $futurSessions,
            'progressSession' => $progressSessions
        ]);
    }
}
