<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Fight;
use App\Entity\Session;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('lastName')
            ->add('firstName')
            ->add('Registration')
            ->add('activities', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('fight', EntityType::class, [
                'class' => Fight::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
