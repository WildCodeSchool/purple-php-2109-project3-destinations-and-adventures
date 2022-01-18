<?php

namespace App\Form;

use App\Entity\Agent;
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
            ->add('commissionType', ChoiceType::class, [
                'choices' => [
                    'Included' => 'included',
                    'On Top Off' => 'on_top_off',
                ],
                'label' => 'Commission Type',
                'placeholder' => 'Choose Commission Type',
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
