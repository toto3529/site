<?php

namespace App\Form;

use App\Entity\Referent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function DI\add;

class TestModifBDControllerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): Void
    {
        $builder
            ->add('nom', EntityType::class, [
                'class' => Referent::class,
                'attr' => ['label' => 'btn-success']
            ])

            ->add('ordre')

            ->add('Enregistrer', SubmitType::class, [
                'attr' => ['class' => 'btn-success'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): Void
    {
        $resolver->setDefaults([
            'data_class' => Referent::class,
        ]);
    }
}
