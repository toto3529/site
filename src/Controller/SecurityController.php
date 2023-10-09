<?php

namespace App\Controller;

use App\Service\SendMailService;
use App\Form\ResetPasswordFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ResetPasswordRequestFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

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

    public function forgottenPassword(Request $request, UserRepository $userRepository, TokenGeneratorInterface $tokenGenerator, EntityManagerInterface $entityManager, SendMailService $mail): Response
    {
        //Fonction de réinitialisation de mot de passe avec formulaire (à commenter si utilisation de la page de secours)

        $requestPassForm = $this->createForm(ResetPasswordRequestFormType::class);

        $requestPassForm->handleRequest($request);

        if($requestPassForm->isSubmitted() && $requestPassForm->isValid()){
            //On va chercher l'utilisateur par son email
            $user = $userRepository->findOneByEmail($requestPassForm->get('email')->getData());

            // On vérifie si on a un utilisateur
            if($user){
                // On génère un token de réinitialisation
                $token = $tokenGenerator->generateToken();
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

                // On génère un lien de réinitialisation du mot de passe
                $url = $this->generateUrl('reset_pass', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
                
                // On crée les données du mail
                $context = compact('url', 'user');

                // Envoi du mail
                $mail->send(
                    'no-reply@velorandonaturebruz.fr',
                    $user->getEmail(),
                    'Réinitialisation de mot de passe',
                    'password_reset',
                    $context
                );

                $this->addFlash('success', 'Email envoyé avec succès');
            return $this->redirectToRoute('app_login');
            } 
    
        $this->addFlash('danger', "Cet email n'existe pas");
        return $this->render('security/reset_password_request.html.twig', [
            'requestPassForm' => $requestPassForm->createView()
        ]);
        }
        return $this->render('security/reset_password_request.html.twig', [
            'requestPassForm' => $requestPassForm->createView()
        ]);

    // à décommenter si l'on n'utilise pas la réinitialisation de mot de passe par formulaire, mais avec la page de secours de réinitialisation dans request.twig.html

    // $president = $userRepository->findOneBy(['referents' => '1']);
    
    //             return $this->render('security/reset_password_request.html.twig', [
    //                 'president' => $president
    //             ]);
    }


    #[Route('/oubli-pass/{token}', name:'reset_pass')]
    public function resetPass(string $token, Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        // On vérifie si on a ce token dans la base
        $user = $userRepository->findOneByResetToken($token);
        
        // On vérifie si l'utilisateur existe

        if($user){
            $passForm = $this->createForm(ResetPasswordFormType::class);

            $passForm->handleRequest($request);

            if($passForm->isSubmitted() && $passForm->isValid()){
                // On efface le token
                $user->setResetToken('');
                
                
                // On enregistre le nouveau mot de passe en le hashant
                $user->setPassword(
                    $passwordHasher->hashPassword(
                        $user,
                        $passForm->get('password')->getData()
                    )
                );
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Mot de passe changé avec succès');
                return $this->redirectToRoute('app_login');
            }

            return $this->render('security/reset_password.html.twig', [
                'passForm' => $passForm->createView()
            ]);
        }
        
        // Si le token est invalide on redirige vers le login
        $this->addFlash('danger', 'Jeton invalide');
        return $this->redirectToRoute('app_login');
    }
}