<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                'placeholder' => 'Entrez votre adresse email',
                ]
            ])
            
            ->add('plainPassword', PasswordType::class, [ 
                'label' => 'Mot de passe', 
                'mapped' => false, 
                'attr' => [ 'autocomplete' => 'new-password', 
                'placeholder' => 'Choisissez un mot de passe' 
                ], 
            ])
            ->add('nom', TextType::class, [ 
            'label' => 'Nom', 
            'attr' => [ 
                'placeholder' => 'Votre nom' 
                ],
            ]);  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
