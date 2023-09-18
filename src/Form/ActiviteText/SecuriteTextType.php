<?php

namespace App\Form\ActiviteText;

use App\Entity\ActiviteContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecuriteTextType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('SecuriteTitle', TextareaType::class,[
                'label' => 'Modifier le titre :'
            ])
            ->add('SecuriteText', TextareaType::class,[
                'label' => 'Modifier le texte :'
            ])
            ->add('SecuritePhoto',FileType::class, [
                'label' => 'Modifier la photo :',
                'mapped' => false,
                'required' => false
            ])
            ->add('Enregistrer',SubmitType::class, [
                'attr' => ['class' => 'btn-success'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActiviteContent::class,
        ]);
    }
}
