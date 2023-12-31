<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PdfStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): Void
    {
        $builder
            ->add('field_name', FileType::class, array(
                    'mapped' => false,
                    'label' => 'choisissez votre fichier')
            )
            ->add('Enregistrer', SubmitType::class, [
                'attr' => ['class' => 'btn-success']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): Void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
