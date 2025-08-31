<?php

namespace App\Form;

use App\Entity\Bureau;
use App\Entity\Club;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ClubType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom du club'
            ])
            ->add('description', null, [
                'label' => 'Description'
            ])
            ->add('bureau', EntityType::class, [
                'class' => Bureau::class,
                'choice_label' => 'name',
                'label' => 'Bureau associé'
            ])
            ->add('logoFile', FileType::class, [
                'label' => 'Logo du club',
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Club::class,
        ]);
    }
}
