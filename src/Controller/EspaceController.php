<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Activite;
use App\Entity\DocPdf;
use App\Form\ActiviteType;
use App\Form\IntroPhoto\TrombiIntroPhotoType;
use App\Form\SearchForm;
use App\Repository\ActiviteRepository;
use App\Repository\IntroPhotoRepository;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class EspaceController extends AbstractController
{
    /**
     * @Route("/trombi", name="trombi")
     * @param UserRepository $userRepository
     * @return Response
     *
     *
     * Cette methode est en charge d'afficher le trombinoscope
     *
     */
    public function index(EntityManagerInterface $entityManager,IntroPhotoRepository $introPhotoRepository, UserRepository $userRepository, Request $request): Response
    {
        //On as accès a cette page a partir du moment qu'on est Adhérent
        $this->denyAccessUnlessGranted("ROLE_USER");

        $photoIntroTrombi = $introPhotoRepository->find("1");

        $formIntroTrombi = $this->createForm(TrombiIntroPhotoType::class, $photoIntroTrombi);

        $formIntroTrombi->handleRequest($request);

        if ($formIntroTrombi->isSubmitted() && $formIntroTrombi->isValid()) {

            $introPhoto = $formIntroTrombi->get('TrombiPhotoIntro')->getData();
            if ($introPhoto != null) {

                $fichier = md5(uniqid()) . '.' . $introPhoto->guessExtension();

                //Copie le fichier dans le dossier photo-profil dans le 'public'
                $introPhoto->move(
                    $this->getParameter('photo_intro'),
                    $fichier
                );
                $photoIntroTrombi->setTrombiPhotoIntro($fichier);
            } else {
                $photoIntroTrombi->setTrombiPhotoIntro($introPhoto);
            }
            $entityManager->persist($photoIntroTrombi);
            $entityManager->flush();
        }
        //On redirige l'utilisateur sur la page espace/index.html.twig.
        return $this->render('espace/index.html.twig', [
            'users' => $userRepository->orderUserByReferentWithPhoto(),
            'photoIntro' => $photoIntroTrombi->getTrombiPhotoIntro(),
            'formPhotoIntro' => $formIntroTrombi->createView()
        ]);
    }

}
