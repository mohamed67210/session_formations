<?php

namespace App\Controller;

use App\Entity\ModuleSession;
use App\Form\ModuleSessionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleSessionController extends AbstractController
{
    // ajouter nouveau module
    #[Route('/module/add', name: 'add_module_session')]
    public function index(ManagerRegistry $doctrine, ModuleSession $module = null, Request $request): Response
    {
        if (!$module) {
            $module = new ModuleSession;
        }
        // construire un formulaire qui va se baser sur le $builder dans SessionType
        $form = $this->createForm(ModuleSessionType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // recuperer les données de session si il existe deja et si il est nul
            $module = $form->getData();

            // on recupere le managere doctrine
            $entityManager = $doctrine->getManager();

            // persist remplace prepare en pdo , on prepare l'objet Employe 
            $entityManager->persist($module);

            //on execute 
            $entityManager->flush();

            // on  retourne vers la page affichage de tous les employés
            return $this->redirectToRoute('list_session');
        }
        return $this->render('module_session/add.html.twig', [
            'formAddModule' => $form->createView()
        ]);
    }
}
