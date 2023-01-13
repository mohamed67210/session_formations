<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Entity\Stagiaire;
use App\Form\FormateurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormateurController extends AbstractController
{
    // 
    // #[Route('/formateur', name: 'list_formateur')]
    // public function index(ManagerRegistry $doctrine): Response
    // {
    //     $formateur = $doctrine->getRepository(Formateur::class)->findAll();
    //     return $this->render('formateur/index.html.twig', [
    //         'formateurs' => $formateur,
    //     ]);
    // }
    //liste formateurs + ajouter nouveau formateur + afficher sessions d'un formateur
    #[Route('/formateur/{id}', name: 'list_sessionFormateur')]
    #[Route('/formateur', name: 'list_formateur')]
    public function index(ManagerRegistry $doctrine, Formateur $formateur = null, Request $request): Response
    {
        $id = $request->attributes->get('_route_params');
        // pour afficher liste des formateurs 
        $formateurs = $doctrine->getRepository(Formateur::class)->findAll();
        // pour formulaire de ajout formateur
        $formateur = new Formateur;
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formateur = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($formateur);
            $entityManager->flush();
            return $this->redirectToRoute('list_formateur');
        }
        //pour afficher sessions d'un formateur
        $oneFormateur = $doctrine->getRepository(Formateur::class)->findOneBy(['id' => $id]);
        return $this->render('formateur/index.html.twig', [
            'formAddFormateur' => $form->createView(),
            'formateurs' => $formateurs,
            'oneFormateur' => $oneFormateur,
        ]);
    }
}
