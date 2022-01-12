<?php

namespace App\Form;

use App\Entity\Supplier;
use App\Entity\SupplierPayment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplierPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('supplier', EntityType::class, [
                'class' => Supplier::class,
                'choice_label' => 'name',
                'label' => 'Supplier',
                'placeholder' => 'Choose a supplier',
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Deposit' => 'deposit',
                    'Final payment' => 'final_payment',
                    'Full payment' => 'fulll_payment',
                ],
                'label' => 'Type of payment',
                'placeholder' => 'Choose a type',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date of payment',
            ])
            ->add('paidAmount', NumberType::class, [
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

            ])
            ->add('dueCommission', NumberType::class, [
                'label' => 'Commission due by supplier',
            ])
            ->add('dueDateCommission', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Commission due date',
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Due' => 'due',
                    'Paid' => 'paid',
                ],
                'label' => 'Status of payment',
                'placeholder' => 'Choose a status',
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Note',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SupplierPayment::class,
        ]);
    }
}
