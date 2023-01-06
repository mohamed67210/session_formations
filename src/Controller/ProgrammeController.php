<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Repository\ProgrammeRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammeController extends AbstractController
{
    #[Route('/programme/{id}', name: 'show_programme')]
    public function index(int $id, ProgrammeRepository $programmeRepository, SessionRepository $sessionRepository): Response
    {
        $session = $sessionRepository->findOneBy(['id' => $id]);
        $programme = $programmeRepository->findBy(['session' => $id]);
        return $this->render('programme/index.html.twig', [
            'programmes' => $programme,
            'session' => $session
        ]);
    }
}
