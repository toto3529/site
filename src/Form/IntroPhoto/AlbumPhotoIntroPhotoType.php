<?php

namespace App\Form\IntroPhoto;

use App\Entity\IntroPhoto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumPhotoIntroPhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('AlbumPhotoPhotoIntro', FileType::class, [
            'label' => "Modifier la photo d'intro des albums photos :",
            'mapped' => false,
            'required' => false
    ])
            ->add('Enregistrer',SubmitType::class, [
                'attr' => ['class' => 'btn-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => IntroPhoto::class,
        ]);
    }
}
