<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Fight;
use App\Entity\User;
use App\Enum\FightResult;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $fight = $builder->getData();

        $op1 = ($fight && $fight->getOpponent1())
            ? $fight->getOpponent1()->getFullName()
            : 'Combattant 1';

        $op2 = ($fight && $fight->getOpponent2())
            ? $fight->getOpponent2()->getFullName()
            : 'Combattant 2';

        $builder
            ->add('date', DateTimeType::class, [
                'widget' => 'single_text',
            ])

            ->add('opponent1', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $user) => $user->getFullName(),
            ])

            ->add('opponent2', EntityType::class, [
                'class' => User::class,
                'choice_label' => fn(User $user) => $user->getFullName(),
            ])

            ->add('result', ChoiceType::class, [
                'choices' => [
                    'En attente' => FightResult::PENDING,
                    "Victoire de $op1" => FightResult::OPPONENT1,
                    "Victoire de $op2" => FightResult::OPPONENT2,
                    'Égalité' => FightResult::DRAW,
                ],
            ])

            ->add('activity', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => fn(Activity $activity) =>
                    method_exists($activity, 'getName')
                        ? $activity->getName()
                        : (method_exists($activity, 'getTitle')
                            ? $activity->getTitle()
                            : 'Activity #' . $activity->getId()),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fight::class,
        ]);
    }
}