<?php

namespace App\Controller;

use App\Entity\CategorieModule;
use App\Entity\ModuleSession;
use App\Form\CategorieModuleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CategorieModuleController extends AbstractController
{
    // afficher categories + formulaire nouvelle categorie + liste des modules d'une categorie
    #[Route('/categorie/{id}/modules', name: 'categorie_module')]
    #[Route('/categorie', name: 'app_categorie')]
    public function index(ManagerRegistry $doctrine, Request $request, CategorieModule $categorie = null): Response
    {
        //formulaire 
        // pour formulaire de ajout formateur
        $categorie = new CategorieModule;
        $form = $this->createForm(CategorieModuleType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();
            return $this->redirectToRoute('app_categorie');
        }
        // chercher tte les categorie
        $categories = $doctrine->getRepository(CategorieModule::class)->findAll();
        // chercher une categorie avec id 
        $id =  $request->attributes->get('_route_params');
        $oneCategorie = $doctrine->getRepository(CategorieModule::class)->findOneBy(['id' => $id]);

        return $this->render('categorie_module/index.html.twig', [
            'categories' => $categories,
            'categoryForm' => $form->createView(),
            'oneCategorie' => $oneCategorie,
        ]);
    }
}
