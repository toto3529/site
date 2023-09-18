<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdhesionType;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class AdhesionController extends AbstractController
{
    /**
     * @Route("/adhesion", name="adhesion")
     * @param Request $request
     * @param Swift_Mailer $mailer
     * @return Response
     *
     * Cette méthode permet d'envoyer un email avec les données saisie par l'utilisateur
     * pour qu'un admin puisse créer un adhérent avec les données.
     *
     */
    public function index(Request $request, Swift_Mailer $mailer, UserRepository $userRepository): Response
    {
        // Stocke l'utilisateur "Président" dans la variable pour affichage de propriétés dans la vue
        $president = $userRepository->findOneBy(['referents' => '1']);

        //On envie les données sur la page adhesion/index.html.twig (adhésion).
        return $this->render('adhesion/index.html.twig', [
            'president' => $president
        ]);

    }
}
