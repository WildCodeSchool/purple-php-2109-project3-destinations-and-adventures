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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/", name="client_payment_",)
 */
class ClientPaymentController extends AbstractController
{
    /**
     * @Route("{booking_id}/client_payment/new", name="new", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
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

            return $this->redirectToRoute(
                'client_payment_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('client_payment/new.html.twig', [
            'booking' => $booking,
            'client_payment' => $clientPayment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("{booking_id}/client_payment/{client_payment_id}/edit", name="edit", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("clientPayment",options={"mapping": {"client_payment_id": "id"}})
     */
    public function edit(
        Request $request,
        ClientPayment $clientPayment,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(ClientPaymentType::class, $clientPayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('client_payment/edit.html.twig', [
            'client_payment' => $clientPayment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("client_payment/{id}/delete", name="delete", methods={"GET", "POST"})
     */
    public function delete(
        Request $request,
        ClientPayment $clientPayment,
        EntityManagerInterface $entityManager
    ): Response {
        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $clientPayment->getId(), $request->request->get('_token'))) {
                $entityManager->remove($clientPayment);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
