<?php

namespace App\Form\AccueilEtiquette;

use App\Entity\EtiquetteContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FourthEtiquetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('FourthEtiquetteText', TextareaType::class, [
                'label' => "Modifier le texte de la 4ème étiquette:"
            ])
            ->add('FourthEtiquetteOverlay', TextareaType::class, [
                'label' => "Modifier l'overlay de la 4ème étiquette:"
            ])
            ->add('FourthEtiquettePhoto', FileType::class, [
                'label' => "Modifier la photo de la 4ème étiquette:",
                'mapped' => false,
                'required' => false
            ])
            ->add('Enregistrer', SubmitType::class, [
                'attr' => ['class' => 'btn-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EtiquetteContent::class,
        ]);
    }
}
