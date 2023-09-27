<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class AdhesionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * Cette méthode permet d'envoyer un email avec les données saisies par l'utilisateur pour qu'un admin puisse créer un adhérent avec les données.
     * 
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     */

    #[Route('/adhesion', name: 'adhesion')]

    public function index(Request $request, MailerInterface $mailer, UserRepository $userRepository): Response
    {
        // Stocke l'utilisateur "Président" dans la variable pour affichage de propriétés dans la vue
        $president = $userRepository->findOneBy(['referents' => '1']);

        //On envie les données sur la page adhesion/index.html.twig (adhésion).
        return $this->render('adhesion/index.html.twig', [
            'president' => $president
        ]);
    }
}
