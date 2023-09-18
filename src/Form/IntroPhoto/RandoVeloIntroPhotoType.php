<?php

namespace App\Form\IntroPhoto;

use App\Entity\IntroPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RandoVeloIntroPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('RandoVeloPhotoIntro', FileType::class, [
                'label' => "Modifier la photo d'intro des Randos Vélos :",
                'mapped' => false,
                'required' => false
            ])
            ->add('Enregistrer',SubmitType::class, [
                'attr' => ['class' => 'btn-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IntroPhoto::class,
        ]);
    }
}
