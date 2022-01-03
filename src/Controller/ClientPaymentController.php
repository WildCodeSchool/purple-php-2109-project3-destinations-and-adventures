<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\ClientPayment;
use App\Form\ClientPaymentType;
use App\Repository\ClientPaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/booking/", name="client_payment_",)
 */
class ClientPaymentController extends AbstractController
{
    /**
     * @Route("{id}/client-payment/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, Booking $booking, EntityManagerInterface $entityManager): Response
    {
        $clientPayment = new ClientPayment();
        $form = $this->createForm(ClientPaymentType::class, $clientPayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientPayment->setBooking($booking);
            $entityManager->persist($clientPayment);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client_payment/new.html.twig', [
            'client_payment' => $clientPayment,
            'form' => $form,
        ]);
    }
}
