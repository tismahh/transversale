<?php

namespace App\Form;

use App\Entity\Bureau;
use App\Entity\Club;
use App\Entity\Event;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de l’événement'
            ])
            ->add('description', null, [
                'label' => 'Description'
            ])
            ->add('startDate', null, [
                'label' => 'Date de début',
                'widget' => 'single_text'
            ])
            ->add('endDate', null, [
                'label' => 'Date de fin',
                'widget' => 'single_text'
            ])
            ->add('capacity', null, [
                'label' => 'Capacité maximale'
            ])
            ->add('organizer', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'login',
                'label' => 'Organisateur'
            ])
            ->add('bureau', EntityType::class, [
                'class' => Bureau::class,
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Bureau concerné'
            ])
            ->add('club', EntityType::class, [
                'class' => Club::class,
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Club concerné'
            ])
            ->add('posterFile', FileType::class, [
                'label' => 'Affiche de l’événement',
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
