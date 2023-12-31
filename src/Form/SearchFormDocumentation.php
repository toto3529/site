<?php


namespace App\Form;


use App\Data\SearchData;

use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormDocumentation extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): Void
    {
        $builder
            ->add('q', TextType::class, [
                'label'             => false,
                'required'          => false,
                'attr'              => [
                    'placeholder'   => 'Rechercher'
                ]
            ])
            ->add('categories', EntityType::class, [
                'label'             => false,
                'required'          => false,
                'class'             => Categorie::class,
                'expanded'          => true,
                'multiple'          => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): Void
    {
        $resolver->setDefaults([
            'data_class'              => SearchData::class,
            'method'                  => 'GET',
            'csrf_protection'         => false,
        ]);
    }

    public function getBlockPrefix(): String
    {
        return '';
    }
}
