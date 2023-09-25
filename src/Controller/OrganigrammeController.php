<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Photo;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Form\OrgaEditNomPrenomType;
use App\Repository\ReferentRepository;
use App\Form\TestModifBDControllerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class OrganigrammeController extends AbstractController
{
    /**
     * Affiche l'organigramme de l'association sur la page "Gestion de l'organigramme"
     */

    #[Route('/gestion-organisation', name : 'app_organigramme')]

    public function affichage ( UserRepository $userRepository): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        // Génère toutes les instances de l'entité User et les affiche dans la vue
        $user = $userRepository->findAll();
        return $this->render('organigramme/index.html.twig', [
            'users' => $user
        ]);
    }


    /**
     * Modifie la propriété "Référent" de l'user sélectionné
     * 
     * @param Request $request
     * @param User $user
     * @return Response
     */

    #[Route('/{id}/edit', name : 'referent_edit', methods : ['GET','POST'])]

    public function edit (Request $request, int $id, User $user, UserPasswordHasherInterface $passwordHasher,
                        UserRepository $userRepository, ReferentRepository $referentRepository,
                        EntityManagerInterface $entityManager):Response
        {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        // Identification du membre concerné
        $user = $userRepository->find($id);

        // Récupération de son Id de référent
        $ref = $user->getReferents();
        $ref->getOrdre();

        //Création du formulaire de sélection des référents
        $form = $this->createForm(TestModifBDControllerType::class);

        //Gere le traitement du formulaire
        $form->handleRequest($request);

        // Si le formulaire a été envoyé et est valide
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            // Récupère le champ "Nom" du formulaire
            $referent = $form->getData();
            $user->setReferents($referent);
            $em->persist($user);
            $em->flush();

            /*
            if ($ref == 'Président'){
                $user->setReferents
            dd($user);
            */


            // Persiste l'instance d'entité sélectionnée (obligatoire sous peine d'erreur)


            // Attribue le référent choisi dans le formulaire à l'user concerné


            // Enregistre en BD la nouvelle instance de l'user et remplace l'ancienne
            $entityManager -> persist($user);
            $entityManager -> flush();

            //Envoi d'un message de succès à l'utilisateur pour confirmer la réussite de la modification
            $this->addFlash('success', 'La qualité "Référent" de ce membre a bien été modifiée');

            //On redirige l'utilisateur sur la page de gestion de l'organigramme
            return $this->redirectToRoute('app_organigramme');
        }

        //On renvoie les données et l'affichage du formulaire sur la page edit.html.twig.
        return $this->render('organigramme/organigramme-edit.twig', [
            'users' => $user,
            'user' => $user,
            'form' => $form->createView(),

        ]);
    }
}
