<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\TrainingSession;
use App\Entity\User;
use App\Enum\TrainingSessionDay;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrainingSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startTime', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Début de l\'entrainement',
            ])

            ->add('endTime', TimeType::class, [
                'widget' => 'single_text',
                'label' => 'Fin de l\'entrainement',
            ])

            ->add('location', TextType::class, [
                'label' => 'Lieu',
            ])

            ->add('activity', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'name',
                'label' => 'Activité',
            ])

            ->add('coach', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $user) =>
                    $user->getFirstName() . ' ' . $user->getLastName(),
            ])

            ->add('days', ChoiceType::class, [
                'choices' => [
                    'Lundi' => TrainingSessionDay::MONDAY,
                    'Mardi' => TrainingSessionDay::TUESDAY,
                    'Mercredi' => TrainingSessionDay::WEDNESDAY,
                    'Jeudi' => TrainingSessionDay::THURSDAY,
                    'Vendredi' => TrainingSessionDay::FRIDAY,
                    'Samedi' => TrainingSessionDay::SATURDAY,
                    'Dimanche' => TrainingSessionDay::SUNDAY,
                ],
                'label' => 'Jours',
                'multiple' => true,
                'expanded' => true,
                'choice_value' => fn(?TrainingSessionDay $choice) => $choice?->value,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TrainingSession::class,
        ]);
    }
}