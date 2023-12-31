<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Form\ActualiteType;
use App\Repository\ActualiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualiteController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * Cette methode est en charge d'afficher l'actualité sur la page Gestion des Actualités
     * 
     * @param ActualiteRepository $actualiteRepository
     * @return Response
     */

    #[Route('/actualite', name: 'actualite')]

    public function actualite(ActualiteRepository $actualiteRepository)
    {
        //on récupère la fonction afficheactu et on la sauvegarde dans $products.
        $products = $actualiteRepository->afficheactu();
        //on redirige la fonction actualite sur la page gestion_actu.html.twig.
        return $this->render('actualite/gestion_actu.html.twig', [
            'actualites' => $products
        ]);
    }

    /**
     * Cette methode est en charge de créer une nouvelle Actualité
     * 
     * @param Request $request
     * @param ActualiteRepository $actualiteRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */

    #[Route('/actu_new', name: 'actu_new')]

    public function new(Request $request, ActualiteRepository $actualiteRepository, EntityManagerInterface $entityManager): Response
    {
        //On laisse l'accès à cette fonction seulement aux Administrateurs.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        //On crée une nouvelle Actualite.
        $actualite = new Actualite();
        //On récupère le formulaire dans ActualiteType.
        $form = $this->createForm(ActualiteType::class, $actualite);

        $form->handleRequest($request);

        //Si le formulaire a été envoyer et est valide ...
        if ($form->isSubmitted() && $form->isValid()) {
            //On envoie les informations à la base de donnée.
            $entityManager->persist($actualite);
            $entityManager->flush();
            //On renvoie un message de succes à l'utilisateur pour prévenir de la réussite de la création.
            $this->addFlash('success', 'Une nouvelle actualité est créée');
            //On redirige l'utilisateur sur la page home/index.html.twig]
            return $this->redirectToRoute('home1');
        }    
        //On envoie les données et l'affichage du formulaire sur la page actu.html.twig.
        return $this->render('actualite/actu.html.twig', [
            'actualite' => $actualite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette methode est en charge de modifier une Actualité
     * 
     * @param Request $request
     * @param Actualite $actualite
     * @return Response
     */

    #[Route('/actuedit/{id}', name: 'actuedit')]

    public function editactu(Request $request, Actualite $actualite, EntityManagerInterface $entityManager): Response
    {
        //On laisse l'accès à cette fonction seulement aux Administrateur.
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //On récupère le formulaire dans ActualiteType.
        $form = $this->createForm(ActualiteType::class, $actualite);

        $form->handleRequest($request);
        //Si le formulaire a été envoyer et est valide ...
        if ($form->isSubmitted() && $form->isValid()) {
            //On envoie les informations de modification à la base de donnée.
            $entityManager->flush();
            //On renvoie un message de succes à l'utilisateur pour prévenir de la réussite de la modification.
            $this->addFlash('success', "l'actualité est bien modifiée");
            //On redirige l'utilisateur sur la page home/index.html.twig
            return $this->redirectToRoute('home1');
        }
        //On envoie les données et l'affichage du formulaire sur la page actu.html.twig.
        return $this->render('actualite/editactu.html.twig', [
            'actualite' => $actualite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Cette methode est en charge de supprimer une Actualité
     * 
     * @param Actualite $actualite
     * @return Response
     */

    #[Route('/actudelete/{id}', name: 'actudelete')]


    public function deleteActualite(Actualite $actualite, EntityManagerInterface $entityManager): Response
    {
        //On laisse l'accès à cette fonction seulement aux Administrateur.
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //On supprime les informations de la base de donnée.
        $entityManager->remove($actualite);
        $entityManager->flush();
        //On renvoie un message de succes à l'utilisateur pour prévenir de la réussite de la suppresion.
        $this->addFlash('success', "L'actualité est bien supprimée");
        //On redirige l'utilisateur sur la page home.html.twig.
        return $this->redirectToRoute('home1');
    }
}
