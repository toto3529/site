<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\PhotoCarousel; 
use App\Form\PhotoCarouselType; 
use Doctrine\ORM\EntityManagerInterface;

class PhotoCarouselController extends AbstractController
{
    #[Route('/photo/carousel', name: 'app_photo_carousel')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérez le tableau de photos à modifier (ici, on suppose que l'entité PhotoCarousel avec l'ID 1 existe)
        $photoCarousel = $entityManager->getRepository(PhotoCarousel::class)->find(1); 

        // $photoCarousel = new PhotoCarousel(); 
        $form = $this->createForm(PhotoCarouselType::class, $photoCarousel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérez l'import de l'image, son stockage et l'enregistrement en base de données

            $imageFields = ['image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7'];
            foreach ($imageFields as $field) {
                $image = $form->get($field)->getData();
                if ($image) {
                    $fileName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move(
                    $this->getParameter('kernel.project_dir') . '/public/photo-carousel',
                    $fileName
                );
                // Utilisez la réflexion pour définir la valeur de chaque champ d'image
                $reflection = new \ReflectionClass($photoCarousel);
                $property = $reflection->getProperty($field);
                $property->setAccessible(true);
                $property->setValue($photoCarousel, $fileName);
            }
        }

            $entityManager->persist($photoCarousel);
            $entityManager->flush();

            // Redirigez l'utilisateur vers la page de gestion des photos du carousel
            return $this->redirectToRoute('app_photo_carousel');
        }

        // Récupérez les albums de photos déjà importés
        $photoCarousels = $entityManager->getRepository(PhotoCarousel::class)->find(1); 

        return $this->render('photo_carousel/index.html.twig', [
            'form' => $form->createView(),
            'photoCarousels' => $photoCarousels,
        ]);
    }
}


