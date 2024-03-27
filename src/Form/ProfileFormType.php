<?php

namespace App\Form;

use App\Entity\Profile;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter name...'
                ),
            ])
            ->add('intro', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter intro...'
                ),
            ])
            ->add('bio', TextareaType::class, [
                'attr' => array(
                    'class' => 'w3-padding  w3-margin-bottom w3-margin-top  w3-input w3-border',
                    'placeholder' => 'Enter my biography...'
                ),
            ])
            ->add('username', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter username...'
                ),
            ])
            ->add('location', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter location...'
                ),
            ])
            ->add('number', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter my number...'
                ),
            ])
            ->add('soc_facebook', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter link on facebook...'
                ),
            ])
            ->add('soc_linkedin', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter link on linkedin...'
                ),
            ])
            // ->add('email')
            ->add('imageUrl', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter link on image...'
                ),
            ])
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
