<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference')
            ->add('name')
            ->add('travelersCount')
            ->add('destination')
            ->add('confirmationDate')
            ->add('departure')
            ->add('returnDate')
            ->add('total')
            ->add('perPerson')
            ->add('depositAmount')
            ->add('dueDepositDate')
            ->add('note')
            ->add('leadCustomer')
            ->add('agent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
