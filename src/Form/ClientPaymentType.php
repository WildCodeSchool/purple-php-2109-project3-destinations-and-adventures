<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\ClientPayment;
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
                'choice_label' => 'name',
                'label' => 'Name',
                'placeholder' => 'Choose a client',

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
                    'Wire Transfert' => 'wire_transfert',
                    'Check' => 'check',
                    'Credit' => 'credit',
                    'Refund' => 'refund',
                ],
                'label' => 'Payment mode',
                'placeholder' => 'Choose a mode',
                'required' => false,

            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Due' => 'due',
                    'Paid' => 'paid',
                ],
                'label' => 'Payment status',
                'placeholder' => 'Choose a status',

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
