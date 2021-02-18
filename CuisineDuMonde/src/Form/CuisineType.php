<?php

namespace App\Form;

use App\Entity\Cuisine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CuisineType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('category', EntityType::class, [
                'class'=> 'App\Entity\Category',
                'placeholder'=>'Veuillez choisir une catégorie',
                'mapped'=>false,
            ])
            ->add('course', EntityType::class, [
                'class'=> 'App\Entity\Course',
                'placeholder'=>'Le type de plat',
                'mapped'=>false,
            ])
            ->add('image', FileType::class)
            ->add('ingredients', HiddenType::class, [
                'data'=>"ingredients here...",
            ])
            ->add('recipe', HiddenType::class, [
                'data'=>"recipe here..."
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cuisine::class,
        ]);
    }
}
