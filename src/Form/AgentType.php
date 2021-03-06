<?php

namespace App\Form;

use App\Entity\Agent;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter the agency name here',
                ]
            ])
            ->add('commission', TextType::class, [
                'attr' => [
                    'placeholder' => 'Amount',
                ]
            ])
            ->add('commissionUnit', ChoiceType::class, [
                'choices' => [
                    '$' => '$',
                    '%' => '%',
                ],
                'label' => '',
                'placeholder' => 'Unit',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Date',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agent::class,
        ]);
    }
}
