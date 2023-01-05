<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{

    // pour afficher liste des entreprise
    #[Route('/home', name: 'app_session')]
    public function index(ManagerRegistry $doctrine): Response
    {

        // recuperer tte les sessions de la bdd
        $repository = $doctrine->getRepository(Session::class);
        $sessions = $repository->findBy([], ['dateDebut' => 'DESC']);
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

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
