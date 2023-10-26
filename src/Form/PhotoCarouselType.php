<?php

namespace App\Form;


use App\Entity\PhotoCarousel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class PhotoCarouselType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): Void
    {
        $builder
            ->add('image1', FileType::class,[
                'label' => 'Image 1',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'La photo doit être de type .png ou jpeg',
                    ])
                ]
            ])

            ->add('image2', FileType::class,[
                'label' => 'image 2',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'La photo doit être de type .png ou jpeg',
                    ])
                ]
            ])

            ->add('image3', FileType::class,[
                'label' => 'image 3',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'La photo doit être de type .png ou jpeg',
                    ])
                ]
            ])

            ->add('image4', FileType::class,[
                'label' => 'image 4',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'La photo doit être de type .png ou jpeg',
                    ])
                ]
            ])

            ->add('image5', FileType::class,[
                'label' => 'image 5',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'La photo doit être de type .png ou jpeg',
                    ])
                ]
            ])

            ->add('image6', FileType::class,[
                'label' => 'image 6',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'La photo doit être de type .png ou jpeg',
                    ])
                ]
            ])

            ->add('image7', FileType::class,[
                'label' => 'image 7',
                'required' => false,
                'mapped' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'La photo doit être de type .png ou jpeg',
                    ])
                ]
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): Void
    {
        $resolver->setDefaults([
            'data_class' => PhotoCarousel::class,
        ]);
    }
}
