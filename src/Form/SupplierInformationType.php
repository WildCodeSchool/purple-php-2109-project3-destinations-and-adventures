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

class SupplierInformationType extends AbstractType
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
            ->add('currency', ChoiceType::class, [
                'choices' => [
                    'EUR' => 'EUR',
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
                    'ISK' => 'ISK',
                    'CHF' => 'CHF',
                    'MKD' => 'MKD',
                    'MDL' => 'MDL',
                    'NOK' => 'NOK',
                    'RSD' => 'RSD',
                    'UAH' => 'UAH',
                    'GIP' => 'GIP',
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
