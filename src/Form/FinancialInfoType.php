<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FinancialInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('total', NumberType::class, [
                'label' => 'Grant total amount $'
            ])
            ->add('perPerson', NumberType::class, [
                'label' => 'Per person amount $'
            ])
            ->add('depositAmount', NumberType::class, [
                'label' => 'Deposit amount $'
            ])
            ->add('dueDepositDate', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Balance due date'
            ])
            ->add('note', TextareaType::class, [
                'label' => 'Notes',
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
