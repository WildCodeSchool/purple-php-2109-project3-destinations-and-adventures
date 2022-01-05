<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GeneralInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Reference #',
                ],
                'required' => false
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Booking name',
                ]
            ])
            ->add('travelersCount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Travelers count',
                ]
            ])
            ->add('leadCustomer', ClientType::class)
            ->add('destination', TextType::class, [
                'attr' => [
                    'placeholder' => 'Destination',
                ]
            ])
            ->add('confirmationDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'Confirmation date',
                ]
            ])
            ->add('departure', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'departure date',
                ]
            ])
            ->add('returnDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'placeholder' => 'return date',
                ]
            ])
            ->add('agent', AgentType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
