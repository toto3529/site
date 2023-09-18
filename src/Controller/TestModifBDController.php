<?php

namespace App\Controller;

use App\Entity\Photo;
use App\Entity\User;
use App\Form\OrgaEditNomPrenomType;
use App\Form\TestModifBDControllerType;
use App\Form\UserType;
use App\Repository\ReferentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class TestModifBDController extends AbstractController
{
    /**
         * @Route("/test/modif/b/d", name="app_test_modif_b_d")
     */
    public function affichage(UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('testtt/testModifBD.html.twig', [
            'users' => $user
        ]);
    }



    /**
     * @Route("/{id}/edit", name="use_edit", methods={"GET","POST"})
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     *
     *
     * Cette methode est en charge de modifier un Utilisateur en tant que Administrateur
     *
     */
    public
    function edit(Request $request, int $id, User $user, UserPasswordEncoderInterface $encoder, UserRepository $userRepository, ReferentRepository $referentRepository, EntityManagerInterface $entityManager): Response
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
