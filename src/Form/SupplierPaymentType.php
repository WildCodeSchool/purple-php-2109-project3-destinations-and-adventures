<?php

namespace App\Form;

use App\Entity\Supplier;
use App\Entity\SupplierPayment;
use App\Repository\SupplierRepository;
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
                'query_builder' => function (SupplierRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.id', 'DESC');
                },
                'choice_label' => 'name',
                'label' => 'Supplier',
                'placeholder' => 'Choose a supplier',
            ])
            ->add('currency', ChoiceType::class, [
                'choices' => [
                    'EUR' => 'EUR',
                    'CHF' => 'CHF',
                    'GBP' => 'GBP',
                    'BGN' => 'BGN',
                    'HRK' => 'HRK',
                    'DKK' => 'DKK',
                    'HUF' => 'HUF',
                    'PLN' => 'PLN',
                    'SEK' => 'SEK',
                    'CZK' => 'CZK',
                    'RON' => 'RON',
                    'ALL' => 'ALL',
                    'BYN' => 'BYN',
                    'BAM' => 'BAM',
                ],
                'label' => false,
                'placeholder' => 'currency',
            ])
            ->add('dueAmount', NumberType::class, [
                'label' => 'Amount due to supplier',
            ])
            ->add('dueDate', DateType::class, [
                'label' => 'Due date',
                'widget' => 'single_text',
            ])
            ->add('exchangeRate', NumberType::class, [
                'label' => 'Exchange rate',
            ])
            ->add('dueDollarsAmount', NumberType::class, [
                'label' => 'Amount in $',
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
            ->add('paidAmount', NumberType::class, [
                'label' => 'Payment Amount $',
                'required' => false,
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
            ])
            ->add('dueCommission', NumberType::class, [
                'label' => 'Commission due by supplier',
                'required' => false,
            ])
            ->add('dueDateCommission', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Commission due date',
                'required' => false,
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
