<?php

namespace App\Form;

use App\Entity\Activite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UrlPhotoAlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): Void
    {
        $builder
            ->add('urlAlbumPhoto', TextType::class, [
                'required' => false,
                'label' => "Première URL Album Photos"
            ])
            ->add('urlAlbumPhotoDeux', TextType::class, [
                'required' => false,
                'label' => "Deuxième URL Album Photos"
            ])
            ->add('Enregistrer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): Void
    {
        $resolver->setDefaults([
            'data_class' => Activite::class,
        ]);
    }
}
