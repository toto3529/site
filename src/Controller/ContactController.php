<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ContactController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * Cette méthode sert à afficher un formulaire de contact sur la page Contact.
     * 
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     */

    #[Route('/contact', name: 'contact')]

    public function index(Request $request, MailerInterface $mailer): Response
    {
        //On créer notre formulaire.
        $form = $this->createForm(ContactType::class);
        //On récupère les information saisi.
        $form->handleRequest($request);
        //Si le formulaire a bien été envoyer et qu'il est valide ...
        if ($form->isSubmitted() && $form->isValid()) {
            //On récupère les information saisie dans le formulaire et on les hydrate dans la variable $contact.
            $contact = $form->getData();

            //ici nous enverrons le mail.
            $message = (new MailerInterface('Nouveau Contact'))
                ->setFrom($contact['email'])

                //on attribue le destinataire - ci-dessous c'est le mail du site.
                ->setTo('vrnb2020@velorandonaturebruz.fr')

                //on créée le message avec la vue twig (qui est dans les templates emails).
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        compact('contact')
                    ),
                    'text/html'
                );

            // on envoie le message
            $mailer->send($message);
            //On renvoie un message de success a l'utilisateur pour prévenir de la réussite.
            $this->addFlash('success', 'Votre message a bien été envoyé');
            //On redirige l'utilisateur sur la page index.html.twig (accueil).
            return $this->redirectToRoute('home1');
        }
        //On envoie les données sur la page index.html.twig (Contact).
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView()
        ]);
    }
}
