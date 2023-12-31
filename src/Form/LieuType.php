<?php

namespace App\Form;

use App\Entity\Lieu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LieuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): Void
    {
        $builder
            ->add('nom_ville', TextType::class,[
                'label'=>'Ville'
            ])
            //->add('cp_ville')
            //->add('num_rue')
            ->add('nom_rue', TextType::class,[
                'label'=>'Adresse'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): Void
    {
        $resolver->setDefaults([
            'data_class' => Lieu::class,
        ]);
    }
}
