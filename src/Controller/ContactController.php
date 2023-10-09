<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\ContactMailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * Cette méthode sert à afficher un formulaire de contact sur la page Contact et de renvoyer un mail à l'administrateur.
     * 
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     */

    #[Route('/contact', name: 'contact')]

    public function index(Request $request, ContactMailService $mail): Response
    {
        //On créer notre formulaire.
        $form = $this->createForm(ContactType::class);
        //On récupère les informations saisi.
        $form->handleRequest($request);
        //Si le formulaire a bien été envoyé et qu'il est valide.
        if ($form->isSubmitted() && $form->isValid()) {

            //On récupère les informations saisies dans le formulaire et on les hydrate dans la variable $context.
            $context = $form->getData();
            
            // Envoi du mail
            $mail->sendContact(
                'no-reply@velorandonaturebruz.fr',
                'vrnb2020@velorandonaturebruz.fr',
                'Mail de demande de contact depuis le formulaire de contact',
                'contact',
                $context
            );

            //On renvoie un message de success à l'utilisateur pour prévenir de la réussite.
            $this->addFlash('success', 'Votre message a bien été envoyé');

            //On rédirige l'utilisateur sur la page d'accueil .
            return $this->redirectToRoute('home1');
        }
        //On envoie les données sur la page index.html.twig (Contact).
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
