<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Referent;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use function Sodium\add;

class OrgaEditNomPrenomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Le champ déroule une liste grâce à EntityType
            ->add('referent', EntityType::class, [
                'class' => Referent::class,
                'choice_label' => 'Poste',
                'placeholder' => "Choisir le nouveau"
            ])






            ->add('Enregistrer', SubmitType::class, [
        'attr' => ['class' => 'btn-success'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Referent::class,
        ]);
    }
}
