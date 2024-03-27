<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class BlogFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            'attr' => array(
                'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                'placeholder' => 'Enter title...'
            ),
            'required' => false
        ])
        ->add('description', TextareaType::class, [
            'attr' => array(
                'class' => 'w3-padding  w3-margin-bottom w3-margin-top  w3-input w3-border',
                'placeholder' => 'Enter Description...'
            ),
            'required' => false
        ])
        ->add('imageUrl', TextType::class, [
            'attr' => array(
                'class' => 'w3-padding  w3-margin-bottom w3-margin-left',
                'placeholder' => 'Enter URL...'
            ),
            'required' => false
        ])
        ->add('tags', EntityType::class, [
            'class' => Tag::class,
            // 'class' => 'w3-padding  w3-margin-bottom w3-margin-left',
            'choice_label' => 'name',
            'multiple' => true,
        ])

        // ->add('tags', TextType::class, [
        //     'attr' => array(
        //         'class' => 'w3-padding  w3-margin-bottom w3-margin-left',
        //         'placeholder' => 'Enter tags...'
        //     ),
        //     'required' => false
        // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
