<?php


namespace App\Controller;


use App\Data\SearchData;
use App\Entity\Activite;
use App\Entity\DocPdf;
use App\Entity\PhotoAlbum;
use App\Form\DocPdfType;
use App\Form\IntroPhoto\AlbumPhotoIntroPhotoType;
use App\Form\PhotoAlbumType;
use App\Form\SearchForm;
use App\Form\UrlPhotoAlbumType;
use App\Repository\ActiviteRepository;
use App\Repository\IntroPhotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class PhotoAlbumController extends AbstractController
{
    /**
     * @Route ("/album", name="album")
     * @param ActiviteRepository $activiteRepository
     * @param Request $request
     * @return Response
     *
     * Cette méthode sert à rediriger l'utilisateur sur la page Album photo,
     * et permet aussi de faire l'affichage des activités avec l'état 'fini' ou 'annulé' et d'afficher un filtre.
     *
     */
    public function album(EntityManagerInterface $entityManager, IntroPhotoRepository $introPhotoRepository, ActiviteRepository $activiteRepository, Request $request): Response
    {
        $photoIntroAlbum = $introPhotoRepository->find("1");


        //On refuse l'accès a cette méthode a l'utilisateur si l'utilisateur n'a pas le rôle User.
        $this->denyAccessUnlessGranted("ROLE_USER");

        //On récupère l'utilisateur en session et on le stocke dans la variable $user
        $user = $this->getUser();

        //On créé une nouvelle instance de dateTime et on récupère la date et l'heure actuelle
        $date = new \DateTime('now');
        //On créé une nouvelle instance de l'objet SearchData et on la stocke dans la variable $data
        $data = new SearchData();
        //On créé nos formulaires
        $form = $this->createForm(SearchForm::class, $data);
        $formIntroAlbum = $this->createForm(AlbumPhotoIntroPhotoType::class, $photoIntroAlbum);

        //On récupère les informations saisies
        $form->handleRequest($request);
        $formIntroAlbum->handleRequest($request);

        //on liste toutes les activités comme le findall mais en une requête
        $products = $activiteRepository->findSearchAlbum($data);
        if ($formIntroAlbum->isSubmitted() && $formIntroAlbum->isValid()) {

            $introPhoto = $formIntroAlbum->get('AlbumPhotoPhotoIntro')->getData();
            if ($introPhoto != null) {

                $fichier = md5(uniqid()) . '.' . $introPhoto->guessExtension();

                //Copie le fichier dans le dossier photo-profil dans le 'public'
                $introPhoto->move(
                    $this->getParameter('photo_intro'),
                    $fichier
                );
                $photoIntroAlbum->setAlbumPhotoPhotoIntro($fichier);
            } else {
                $photoIntroAlbum->setAlbumPhotoPhotoIntro($introPhoto);
            }
            $entityManager->persist($photoIntroAlbum);
            $entityManager->flush();
        }
        //On envoie les données récupérées sur la page album_photo.html.twig.
        return $this->render('album/album_photo.html.twig',[
            'user' => $user,
            /**'activites' => $acti,*/
            'date' => $date,
            'activites'=> $products,
            'form' => $form->createView(),
            'photoIntro' => $photoIntroAlbum->getAlbumPhotoPhotoIntro(),
            'formPhotoIntro' => $formIntroAlbum->createView()
        ]);
    }

    /**
     * @Route ("/album/create/{id}", name="create_album")
     * @param Request $request
     * @param Activite $activite
     * @return Response
     *
     * Cette méthode sert à créer une image et a la lier a une activité.
     * La méthode ne dispose pas de redirection pour permettre à l'utilisateur
     * d'insérer plusieurs images sans gène.
     *
     */
    public function createAlbum(Request $request, Activite $activite): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");
        //On créé une nouvelle instance de l'objet PhotoAlbum et on le stocke dans la variable $album.
        $album = new PhotoAlbum();
        //On créé notre formulaire.
        $form = $this->createForm(PhotoAlbumType::class, $album);
        //On récupère les informations saisies.
        $form->handleRequest($request);
        //Si le formulaire a bien été envoyé et qu'il est valide ...
        if ($form->isSubmitted() && $form->isValid())
        {
            //On injecte l'activité dans le setter activite
            //de cette façon l'activité et l'album sont liés par le même id.
            $album->setActivite($activite);
            //Si la propriété image n'est pas null (vide)...
            if( $album->getImage() != null )
            {
                //On stocke le nom du fichier dans la variable $file.
                $file = $album->getImage();
                //On renomme le fichier avec un nom unique et on lui ajoute l'extension contenue
                //dans la variable $file, on stocke le tout dans la variable $fileName.
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                //On déplace le fichier dans le repository album-photo.
                $file->move($this->getParameter('album_directory'),$fileName);
                //On injecte le nouveau nom du fichier dans la propriété image.
                $album->setImage($fileName);
            }
            //On envoie les informations à la base de données.
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($album);
            $entityManager->flush();
            //On renvoie un message de success à l'utilisateur pour prévenir de la réussite.
            $this->addFlash('success', 'Votre image est bien insérée dans l\'album');
        }
        //On envoie les données sur la page new_album.html.twig
        return $this->render('album/new_album.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/show/album/{id}", name="show_album")
     * @param Activite $activite
     * @param ActiviteRepository $activiteRepository
     * @return Response
     *
     * Cette méthode est en charge de l'affichage d'une activité (plus détaillé),
     * de l'affichage des pdf et des images qui lui sont liées.
     *
     */
    public function showAlbum(EntityManagerInterface $entityManager, Request $request, Activite $activite, ActiviteRepository $activiteRepository): Response
    {
        //On recherche une activité par son id et on la stocke dans la variable $activite grâce a la méthode FindOneBy.
        $activite = $activiteRepository->findOneBy(['id'=> $activite]);

        //On récupère le formulaire pour les urls
        $form = $this->createForm(UrlPhotoAlbumType::class,$activite);
        $form->handleRequest($request);

        // Si le formulaire a été envoyé et est valide
        if($form->isSubmitted() && $form->isValid()){
            //On envoie les informations à la base de donnée.
            $url = $form->getData();
            $entityManager->persist($url);
            $entityManager->flush();
        }

        //On envoie les données sur la page show_album.html.twig
        return $this->render('album/show_album.html.twig',[
            'activite' => $activite,
            'form' => $form->createView(),
            'photoPdf' => $activite->getPdf()
        ]);
    }

    /**
     * @Route ("/delete/album/{id}", name="delete_album")
     * @param PhotoAlbum $photoAlbum
     * @return Response
     *
     * Cette méthode sert à supprimer les photos stockées dans une activité.
     *
     */
    public function deleteAlbum(PhotoAlbum $photoAlbum): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $entityManager = $this->getDoctrine()->getManager();
        //Si la propriété image n'est pas null (vide)...
        if ($photoAlbum->getImage() != null)
        {
            //On récupère le nom de l'image stockée en base de données et on le stocke dans la variable $nom.
            $nom = $photoAlbum->getImage();
            //On supprime le fichier stocké dans le repository album-photo.
            unlink($this->getParameter('album_directory').'/'.$nom);
        }
        //On supprime le fichier stocké dans la base de données
        $entityManager->remove($photoAlbum);
        $entityManager->flush();
        //On renvoie un message de success pour prévenir l'utilisateur de la réussite.
        $this->addFlash('success', 'L\'image a bien été supprimé de l\'album');
        //On redirige l'utilisateur sur la page album.html.twig.
        return $this->redirectToRoute('album');
    }

    /**
     * @Route ("/pdf/create/{id}", name="create_pdf")
     * @param Request $request
     * @param Activite $activite
     * @return Response
     *
     * Cette méthode est en charge de créer un pdf et de le lier à une activité.
     *
     */
    public function createPdf(Request $request, Activite $activite): Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        //On créé une nouvelle instance de l'objet DocPdf et on le stocke dans la variable $pdf.
        $pdf = new DocPdf();
        //On créé notre formulaire.
        $form = $this->createForm(DocPdfType::class, $pdf);
        //On récupère les informations saisies.
        $form->handleRequest($request);
        //Si le formulaire a bien été envoyé et qu'il est valide ...
        if ($form->isSubmitted() && $form->isValid())
        {
            //On injecte l'activité dans le setter pdfactivite
            //de cette façon l'activité et le pdf sont liés par le même id.
            $pdf->setPdfactivite($activite);
            //Si la propriété nom de l'objet pdf est diffèrent de null(rien)...
            if ($pdf->getNompdf() != null)
            {
                //on stocke le nom du fichier dans la variable $file.
                $file = $form->get('nompdf')->getData();
                //On renomme le fichier avec un nom unique et on lui ajoute l'extension contenue dans le $file
                //on stocke le tout dans la variable $fileName.
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                //On déplace le fichier contenu dans $file dans le repository recap
                //on stocke le fichier pdf dans ce repository.
                $file->move($this->getParameter('upload_recap_directory'),$fileName);
                //On injecte le nom unique créé précédemment dans l'attribut nom.
                $pdf->setNompdf($fileName);
            }
            //On envoie les informations à la base de données.
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pdf);
            $entityManager->flush();
            //On envoie un message de success pour prévenir l'utilisateur de la réussite.
            $this->addFlash('success', 'Votre pdf a bien été créé');
            //On redirige l'utilisateur vers la page album_photo.html.twig.
            return $this->redirectToRoute('album');
        }
        //On envoie l'affichage du formulaire sur la page new_pdf.html.twig.
        return $this->render('album/new_pdf.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/delete/pdf/{id}", name="delete_pdf")
     * @param DocPdf $docPdf
     * @return Response
     *
     * cette méthode est en charge supprimer un pdf.
     *
     */
    public function deletePdf(DocPdf $docPdf):Response
    {
        //On refuse l'accès à cette méthode si l'utilisateur n'a pas le rôle Admin.
        $this->denyAccessUnlessGranted("ROLE_ADMIN");

        $entityManager = $this->getDoctrine()->getManager();
        //Si la propriété image n'est pas null (vide)...
        if ($docPdf->getNompdf() != null)
        {
            //On récupère le nom de l'image stockée en base de données.
            $nom = $docPdf->getNompdf();
            //On supprime le fichier stocké dans le repository recap.
            unlink($this->getParameter('upload_recap_directory').'/'.$nom);
        }
        //On supprime les valeur stockées dans la base de données.
        $entityManager->remove($docPdf);
        $entityManager->flush();
        //On renvoie un message à l'utilisateur pour lui confirmer la suppression du pdf.
        $this->addFlash('success','Le pdf a bien été supprimé');
        //On redirige l'utilisateur sur la page album.html.twig.
        return $this->redirectToRoute('album');
    }
}