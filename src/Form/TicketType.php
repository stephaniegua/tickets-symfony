<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('auteur', EmailType::class, [
                'label' => 'Votre adresse e-mail',
                'required' => true,
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['minlength' => 20, 'maxlength' => 250],
                'label' => 'Description du problème',
                'required' => true,
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Incident' => 'Incident',
                    'Panne' => 'Panne',
                    'Evolution' => 'Evolution',
                    'Anomalie' => 'Anomalie',
                    'Information' => 'Information',
                ],
                'label' => 'Catégorie du problème',
                'required' => true,
            ])
            ->add('responsable', TextType::class, [
                'label' => 'Responsable du ticket',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
