<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{

    // ajouter nouvelle formation
    #[Route('/formation/add', name: 'add_formation')]
    public function add(ManagerRegistry $doctrine, Formation $formation = null, Request $request): Response
    {
        // si le formation n'existe pas on instancie un nouveau  
        // if (!$formation) {
        //     $formation = new Formation();
        // }
        // construire un formulaire qui va se baser sur le $builder dans formationType
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        // isValid () remplace les filter input 
        if ($form->isSubmitted() && $form->isValid()) {
            // recuperer les données inserer dans le formulaire et les injecter dans l'objet entreprise grace au seter
            $formation = $form->getData();
            // on recupere le managere doctrine
            $entityManager = $doctrine->getManager();
            // persist remplace prepare en pdo , on prepare l'objet entreprise 
            $entityManager->persist($formation);
            // execute,inserer les données dans la bdd
            $entityManager->flush();
            // retourner a la page qui affiche toutes les entreprises
            return $this->redirectToRoute('list_formation');
        }
        return $this->render('formation/add.html.twig', [
            'formAddFormation' => $form->createView(),
        ]);
    }
    // supprimer formation
    #[Route('/formation/{id}/delete', name: 'delete_formation')]
    public function remove(ManagerRegistry $doctrine, Formation $formation): Response
    {
        $entityManager = $doctrine->getManager();
        $formation =  $entityManager->getRepository(Formation::class)->remove($formation);
        $entityManager->flush();
        return $this->redirectToRoute('list_formation');
    }
    // liste des formations
    #[Route('/formation', name: 'list_formation')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $formation = $doctrine->getRepository(Formation::class)->findAll();
        return $this->render('formation/index.html.twig', [
            'formations' => $formation,
            'formationSessions' => []
        ]);
    }
    // function pour afficher sessions d'une formation
    #[Route('/formation/{id}', name: 'show_sessions')]
    public function show(ManagerRegistry $doctrine, Formation $formation, int $id): Response
    {
        $formation = $doctrine->getRepository(Formation::class)->findOneBy(['id' => $id]);
        $formations = $doctrine->getRepository(Formation::class)->findAll();
        return $this->render('formation/index.html.twig', [
            'formationSessions' => $formation,
            'formations' => $formations
        ]);
    }
}
