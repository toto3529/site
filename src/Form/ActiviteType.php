<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\CategorieFormation;




use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;


class ActiviteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('categoriesFormation', EntityType::class,[
                'class' => CategorieFormation::class,
            ])
            ->add('date_activite', DateTimeType::class,[
                'widget' => 'single_text',
            ])
            ->add('duree')
            ->add('distance')
            ->add('infos_activite', TextareaType::class)
            ->add('denivele')
            ->add('difficulte', ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    "3" => 3,

                ],])

            ->add('lieu', LieuType::class, [

            ])
            ->add('totalParticipant', IntegerType::class, [
                'label' => 'nombre total de Participants',
                'required' => false
            ])
            ->add('pdf', FileType::class, [
                'label' => 'PDF',
                'required' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'maxSize' => '1200k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Le fichier doit être de type .pdf',
                    ])
                ]
            ])

            ->add('Valider', SubmitType::class, [
                'attr' => ['class' => 'btn-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activite::class,
        ]);
    }
}
