<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\ClientPayment;
use App\Repository\ClientRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'query_builder' => function (ClientRepository $er) {
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.id', 'DESC');
                },
                'choice_label' => 'name',
                'label' => 'Name',
                'placeholder' => 'Choose a client',
                'attr' => [
                    'class' => 'form-select',
                ]

            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Deposit' => 'deposit',
                    'Final payment' => 'final_payment',
                    'Full payment' => 'fulll_payment',
                ],
                'label' => 'Type of payment',
                'placeholder' => 'Choose a type',
                'required' => false,
                'attr' => [
                    'class' => 'form-select',
                ]

            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date of payment',
                'required' => false,

            ])
            ->add('amount', NumberType::class, [
                'label' => 'Payment Amount $',

            ])
            ->add('mode', ChoiceType::class, [
                'choices' => [
                    'Credit Card' => 'credit_card',
                    'Wire Transfer' => 'wire_transfer',
                    'Check' => 'check',
                    'Credit' => 'credit',
                    'Refund' => 'refund',
                ],
                'label' => 'Payment mode',
                'placeholder' => 'Choose a mode',
                'required' => false,
                'attr' => [
                    'class' => 'form-select',
                ]

            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Due' => 'due',
                    'Paid' => 'paid',
                ],
                'label' => 'Payment status',
                'placeholder' => 'Choose a status',
                'attr' => [
                    'class' => 'form-select',
                ]

            ])

            ->add('note');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientPayment::class,
        ]);
    }
}
