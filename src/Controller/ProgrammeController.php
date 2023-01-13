<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\SessionRepository;
use App\Repository\ProgrammeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammeController extends AbstractController
{
    // ajouter programme a une session 
    #[Route('/programme/add/{id}', name: 'add_programme')]
    #[ParamConverter('session', options: ["mapping" => ["id" => "id"]])]
    public function add(Session $session, ManagerRegistry $doctrine, Programme $programme = null, Request $request): response
    {

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

            return $this->redirectToRoute('show_programme', ['id' => $session->getId()]);
        }

        // vue pour afficher le formulare d'ajout
        return $this->render('programme/add.html.twig', [
            'formAddProgramme' => $form->createView()
        ]);
    }


    // afficher programme d'une session
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
