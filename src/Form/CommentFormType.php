<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Comment;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('created', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'w3-padding  w3-margin-bottom w3-margin-top  w3-input w3-border',
                    'placeholder' => 'Enter comment...'
                ),
                'required' => false
            ])
            // ->add('rate')
            // ->add('profile', EntityType::class, [
            //     'class' => Profile::class,
            //     'choice_label' => 'id',
            // ])
            // ->add('blog', EntityType::class, [
            //     'class' => Blog::class,
            //     'choice_label' => 'id',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
