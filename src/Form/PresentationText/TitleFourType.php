<?php

namespace App\Form\PresentationText;

use App\Entity\TextPresentation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TitleFourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): Void
    {
        $builder
            ->add('titleFour', TextareaType::class, [
                'label' => 'Quatrième titre'
            ])
            ->add('Enregistrer', SubmitType::class, [
                'attr' => ['class' => 'btn-success'],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): Void
    {
        $resolver->setDefaults([
            'data_class' => TextPresentation::class,
        ]);
    }
}
