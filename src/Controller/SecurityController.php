<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * Cette méthode est en charge de connecter un utilisateur
     * 
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */

    #[Route('/login', name: 'app_login')]

    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        //Récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        //Conserve le nom d'utilisateur après l'echec de connexion
        $lastUsername = $authenticationUtils->getLastUsername();
        //On envoie un message vide d'échec de tentative de connexion (permet de faire afficher le msg d'erreur de connection
        //sous la navbar, qui est présent dans l'authenticator.php) (Si cette ligne n'est pas présente, le msg s'affiche dans la navbar)
        $this->addFlash('Echec', '');

        //On redirige l'utilisateur sur la page login.html.twig
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route('/logout', name : 'app_logout')]

    public function logout()
    {
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/oubli-pass', name:'forgotten_password')]

    public function forgottenPassword() :Response
    {
        return $this->render('security/reset_password_request.html.twig');
    }
}
