<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Activite;
use App\Form\ActiviteType;
use App\Form\IntroPhoto\ProgrammeIntroPhotoType;
use App\Form\SearchForm;
use App\Repository\ActiviteRepository;
use App\Repository\DocPdfRepository;
use App\Repository\EtatRepository;
use App\Repository\IntroPhotoRepository;
use App\Repository\PhotoAlbumRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/activite")
 */
class ActiviteController extends AbstractController
{
    /**
     * @Route("/", name="activite_index")
     * @param ActiviteRepository $activiteRepository
     * @param Request $request
     * @return Response
     *
     * Cette méthode est en charge de rediriger l'utilisateur sur la page Programme,
     * d'afficher les activités avec un état 'ouvert' ou 'modifié' et d'afficher un filtre.
     *
     */
    public function index(EntityManagerInterface $entityManager, IntroPhotoRepository $introPhotoRepository, ActiviteRepository $activiteRepository, Request $request): Response
    {
        $photoIntroProgramme = $introPhotoRepository->find("1");

        //On récupère l'utilisateur en session et on le stocke dans la variable $user
        $user = $this->getUser();
        //On créé une nouvelle instance de dateTime et on récupère la date et l'heure actuelle
        $date = new DateTime('now');
        //On créé une nouvelle instance de l'objet SearchData et on la stocke dans la variable $data
        $data = new SearchData();

        //On créé nos formulaires
        $form = $this->createForm(SearchForm::class, $data);
        $formIntroProgramme = $this->createForm(ProgrammeIntroPhotoType::class, $photoIntroProgramme);

        //On récupère les informations saisies
        $form->handleRequest($request);
        $formIntroProgramme->handleRequest($request);

        //on liste toutes les activités comme le findall mais en une requête
        $products = $activiteRepository->findSearch($data);

        #on liste toutes les activités comme le findall mais en une requete
        /**$acti = $activiteRepository->findSearch();**/

        # on cherche les activités dont la date est dépassée et on change leur état en 'finie'
        $acti2 = $activiteRepository->miseajouretat();

        # on met à jour l'etat qd on va sur la page de liste des activités
        $acti2;

        if ($formIntroProgramme->isSubmitted() && $formIntroProgramme->isValid()) {

            $introPhoto = $formIntroProgramme->get('ProgrammePhotoIntro')->getData();
            if ($introPhoto != null) {

                $fichier = md5(uniqid()) . '.' . $introPhoto->guessExtension();

                //Copie le fichier dans le dossier photo-profil dans le 'public'
                $introPhoto->move(
                    $this->getParameter('photo_intro'),
                    $fichier
                );
                $photoIntroProgramme->setProgrammePhotoIntro($fichier);
            } else {
                $photoIntroProgramme->setProgrammePhotoIntro($introPhoto);
            }
            $entityManager->persist($photoIntroProgramme);
            $entityManager->flush();
        }
        //On envoie les données sur la page index.html (Programme).
        return $this->render('activite/index.html.twig', ['user' => $user,
            /**'activites' => $acti,*/
            'date' => $date,
            'activites' => $products,
            'form' => $form->createView(),
            'photoIntro' => $photoIntroProgramme->getProgrammePhotoIntro(),
            'formPhotoIntro' => $formIntroProgramme->createView()
        ]);
    }

    /**
     * @Route("/new", name="activite_new", methods={"GET","POST"})
     * @param Request $request
     * @param EtatRepository $etatRepository
     * @return Response
     *
     * Cette méthode sert a créer une activité.
     *
     */
    public
    function new(Request $request, EtatRepository $etatRepository): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        //On récupère l'utilisateur en session et on le stocke dans la variable $user.
        $user = $this->getUser();
        //On créé une nouvelle instance d'Activite et on la stocke dans la variable $activite.
        $activite = new Activite();

        //On créé notre formulaire.
        $form = $this->createForm(ActiviteType::class, $activite);
        //On récupère les informations saisies.
        $form->handleRequest($request);
        //Si le formulaire a bien été envoyé et qu'il est valide ...
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            //on hydrate l'activite avec l'organisateur.
            $activite->setOrganisateur($user);

            #pour indiquer automatiquement l'etat 'ouverte' lors de la creation de l'activité
            $etat = $etatRepository->findOneBy(['libelle' => 'ouverte']);
            $activite->setEtat($etat);

            // pour stocker le pdf dans un dossier
            if($activite->getPdf() != null){
                $file = $activite->getPdf();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('pdf_activite_directory'),$fileName);
                $activite->setPdf($fileName);
                $activite->setPdfModification($fileName);

            }

            //On envoie les informations à la base de données.
            $entityManager->persist($activite);
            $entityManager->flush();
            //On renvoie un message de success à l'utilisateur pour prévenir de la réussite.
            $this->addFlash('success', 'Une nouvelle activité est créée !');
            //On redirige l'utilisateur sur la page index.html.twig (Programme).
            return $this->redirectToRoute('activite_index');
        }

        //On envoie les données sur la page new.html.twig (Formulaire de création).
        return $this->render('activite/new.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
            'user' => $user


        ]);
    }

    /**
     * @Route("/{id}", name="activite_show", methods={"GET"})
     * @param Activite $activite
     * @return Response
     *
     *
     *
     */
    public function show(Activite $activite): Response
    {
        return $this->render('activite/show.html.twig', [
            'activite' => $activite,
        ]);
    }

    /**
     * @Route("/show/pdf/{id}", name="activite_show_pdf")
     * @param Activite $activite
     * @param ActiviteRepository $activiteRepository
     * @return Response
     *
     * Cette méthode permet d'afficher le pdf de l'activité s'il est présent
     */
    public function showPdf(Activite $activite, ActiviteRepository $activiteRepository,Request $request): Response
    {
        //On récupère une activité en fonction de son identifiant
        $activites = $activiteRepository->findOneBy(['id' => $activite]);


        return $this->render('activite/show_pdf.html.twig', [
            'activites' => $activites,
        ]);
    }




    /**
     * @Route("/{id}/edit", name="activite_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Activite $activite
     * @param EtatRepository $etatRepository
     * @return Response
     *
     * Cette méthode sert a modifié une activité
     *
     */
    public function edit(Request $request, Activite $activite, EtatRepository $etatRepository): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        //pour récuperer le user en session et on le stocke dans la variable $user.
        $user = $this->getUser();
        //on hydrate l'activite avec l'organisateur.
        $activite->setOrganisateur($user);

        #on met l'etat de l'activité à 'modifiée' qd on modifie
        $etat = $etatRepository->findOneBy(['libelle' => 'modifiée']);
        $activite->setEtat($etat);
        //On créé notre formulaire.
        $form = $this->createForm(ActiviteType::class, $activite);
        //On récupère les informations saisies.
        $form->handleRequest($request);
        //Si le formulaire a bien été envoyé et qu'il est valide ...
        if ($form->isSubmitted() && $form->isValid()) {

            // pour stocker le pdf dans un dossier
            if($activite->getPdf() != null){
                $file = $activite->getPdf();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('pdf_activite_directory'),$fileName);
                $activite->setPdf($fileName);
                $activite->setPdfModification($fileName);
            }

            //On supprime le fichier stocké dans la base de données
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "L'activité est bien modifiée !");
            //On redirige l'utilisateur sur la page album.html.twig.
            return $this->redirectToRoute('activite_index');
        }
        //On envoie les données sur la page edit.html.twig
        return $this->render('activite/edit.html.twig', [
            'activite' => $activite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/delete/{id}", name="delete_activite")
     * @param Activite $activite
     * @param DocPdfRepository $docPdfRepository
     * @param PhotoAlbumRepository $photoAlbumRepository
     * @return Response
     *
     * Cette méthode sert à supprimer une activité et un fichier pdf s'il y en a un de lié.
     */
    public function deleteActivite(Activite $activite, DocPdfRepository $docPdfRepository, PhotoAlbumRepository $photoAlbumRepository): Response
    {
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        $pdf = $docPdfRepository->findOneBy(['pdfactivite' => $activite]);
        $photo = $photoAlbumRepository->findOneBy(['activite' => $activite]);

        $entityManager = $this->getDoctrine()->getManager();

        if ($pdf != null) {
            $nompdf = $pdf->getNompdf();
            $pdfexist = $this->getParameter('upload_recap_directory') . '/' . $nompdf;

            //si le pdf existe dans le dossier public, alors on l'efface
            if ($pdfexist) {
                unlink($pdfexist);
            }
        }

        while ($photo != null) {
            $nomphoto = $photo->getImage();
            $photoexist = $this->getParameter('album_directory') . '/' . $nomphoto;

            if ($photoexist) {
                unlink($photoexist);
            }
            $entityManager->remove($photo);
            $entityManager->flush();
            $photo = $photoAlbumRepository->findOneBy(['activite' => $activite]);
        }


        //On supprime le fichier stocké dans la base de données
        $entityManager->remove($activite);
        $entityManager->flush();

        //On renvoie un message de success pour prévenir l'utilisateur de la réussite.
        $this->addFlash('success', "L'activité à bien été éffacée !");
        //On redirige l'utilisateur sur la page index.html.twig (Accueil)
        return $this->redirectToRoute('activite_index');
    }

    /**
     * @Route("/{id}/sinscrire", name="activite_sinscrire", methods={"GET","POST"})
     * @param Activite $activite
     * @return Response
     *
     * Cette méthode sert a s'inscrire a une activité.
     *
     */

    public function sinscrire(Activite $activite): Response
    {

        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle User.
        $this->denyAccessUnlessGranted("ROLE_USER");
        //On récupère les informations de l'utilisateur stocké en session.
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        //On ajoute l'utilisateur à la liste des inscrits.
        $activite->addUser($user);
        //On supprime le fichier stocké dans la base de données
        $entityManager->persist($activite);
        $entityManager->flush();
        //On renvoie un message de success pour prévenir l'utilisateur de la réussite.
        $this->addFlash('success', 'Vous êtes bien inscrits à une activité !');
        //On redirige l'utilisateur sur la page index.html.twig (Accueil).
        return $this->redirectToRoute('activite_index');
    }


    /**
     * @Route("/{id}/sedesister", name="activite_sedesister", methods={"GET","POST"})
     * @param Activite $activite
     * @return Response
     *
     * Cette méthode sert à se désister d'une activité.
     *
     */
    public function sedesister(Activite $activite): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle User.
        $this->denyAccessUnlessGranted("ROLE_USER");
        //On récupère les informations de l'utilisateur stocké en session.
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        //On supprime l'utilisateur de la liste des inscrits.
        $activite->removeUser($user);
        //On supprime le fichier stocké dans la base de données
        $entityManager->persist($activite);
        $entityManager->flush();
        //On renvoie un message de success pour prévenir l'utilisateur de la réussite.
        $this->addFlash('success', 'Votre désincription est prise en compte !');
        //On redirige l'utilisateur sur la page index.html.twig (Accueil).
        return $this->redirectToRoute('activite_index');
    }

    /**
     * @Route ("/{id}/annuler", name="activite_annuler",methods={"GET","POST"})
     * @param Activite $activite
     * @param EtatRepository $etatRepository
     * @return Response
     *
     * Cette activité sert a annulé une activité.
     *
     */
    public function annuler(Activite $activite, EtatRepository $etatRepository): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle User.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $entityManager = $this->getDoctrine()->getManager();

        //on met l'état en tant que annulé dans la bdd.
        $etat = $etatRepository->findOneBy(['libelle' => 'annulée']);
        //On change l'état de l'activité à annuler.
        $activite->setEtat($etat);
        //On supprime le fichier stocké dans la base de données
        $entityManager->persist($activite);
        $entityManager->flush();
        //On renvoie un message de success pour prévenir l'utilisateur de la réussite.
        $this->addFlash('success', "L'activité est annulée !");
        //On redirige l'utilisateur sur la page index.html.twig (Accueil).
        return $this->redirectToRoute('activite_index');
    }
}
