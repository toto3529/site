<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class ProgramController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/administrateur', name : 'administrateur')]

    public function programIndex(): Response
    {
        #Attention contrairement à son nom, cette fonction affiche la page administrateur

        $this->denyAccessUnlessGranted("ROLE_ADMIN");


        return $this->render('program/programList.twig');
    }
}
