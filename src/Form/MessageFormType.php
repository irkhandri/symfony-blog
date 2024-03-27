<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class MessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter subject...'
                ),
                'required' => false
            ])
            ->add('text', TextareaType::class, [
                'attr' => array(
                    'class' => 'w3-padding  w3-margin-bottom w3-margin-top  w3-input w3-border',
                    'placeholder' => 'Enter message...'
                ),
                'required' => false
            ])
            ->add('email', TextType::class, [
                'attr' => array(
                    'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
                    'placeholder' => 'Enter email...'
                ),
                'required' => true
            ])
            // ->add('name', TextType::class, [
            //     'attr' => array(
            //         'class' => 'w3-padding block w3-margin-bottom w3-margin-left',
            //         'placeholder' => 'Enter name...'
            //     ),
            //     'required' => false
            // ])
            // ->add('is_read', null,[
            //     'required' => false
            // ])
            // ->add('created', null, [
            //     'widget' => 'single_text',
            //     'required' => false
            // ])
            // ->add('sender', EntityType::class, [
            //     'class' => Profile::class,
            //     'choice_label' => 'id',
            //     'required' => false
            // ])
            // ->add('recipient', EntityType::class, [
            //     'class' => Profile::class,
            //     'choice_label' => 'id',
            //     'required' => false
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
