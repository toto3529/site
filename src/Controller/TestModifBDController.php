<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\TestModifBDControllerType;
use App\Repository\ReferentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestModifBDController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/test/modif/b/d', name : 'app_test_modif_b_d')]
    
    public function affichage(UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('testtt/testModifBD.html.twig', [
            'users' => $user
        ]);
    }

    /**
     * Cette methode est en charge de modifier un Utilisateur en tant qu'Administrateur
     * 
     * @param Request $request
     * @param User $user
     * @param UserPasswordHasherInterface $passwordHasher
     * @return Response
     */

    #[Route('/{id}/edit', name : 'use_edit', methods : ['GET','POST'])]

    public function edit(Request $request, int $id, User $user, UserPasswordHasherInterface $passwordHasher, UserRepository $userRepository, ReferentRepository $referentRepository, EntityManagerInterface $entityManager): Response
    {
        //Il faut être minimum Administrateur pour avoir accès a cette methode
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        // On liste tous les référents
        $referent = $referentRepository->find($id);
        $user = $userRepository->find($id);

        //Création du formulaire de sélection des référents
        $form = $this->createForm(TestModifBDControllerType::class, $referent);

        //Gere le traitement du formulaire
        $form->handleRequest($request);

        //Si le formulaire a été envoyer et est valide ...
        if ($form->isSubmitted() && $form->isValid()) {
            $ref = $form->getData('nom');

            $entityManager -> persist($ref);
            $user->setReferents($ref);

            $entityManager -> persist($user);
            $entityManager -> flush();

            //On renvoie un message de succes à l'utilisateur pour prévenir de la réussite de la modification.
            $this->addFlash('success', 'Le profil a bien été modifié !!');
            //On redirige l'utilisateur sur la page user/index.html.twig.
            return $this->redirectToRoute('app_test_modif_b_d');
            }

        //On renvoie les données et l'affichage du formulaire sur la page edit.html.twig.
        return $this->render('testtt/testModifBDEdit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
            'referent'=> $referent,

        ]);
    }
}
