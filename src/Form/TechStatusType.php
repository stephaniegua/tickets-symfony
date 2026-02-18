<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\Statut;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TechStatusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statut', EntityType::class, [
                'class' => Statut::class,
                'choice_label' => 'nom',
                'label' => 'Nouveau statut',
            ]);
    }
}
