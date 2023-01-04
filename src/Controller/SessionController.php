<?php

namespace App\Controller;

use App\Entity\Session;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    // pour afficher liste des entreprise
    #[Route('/session', name: 'app_session')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // recuperer tte les sessions de la bdd
        $sessions = $doctrine->getRepository(Session::class)->findBy([], );
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }
}
