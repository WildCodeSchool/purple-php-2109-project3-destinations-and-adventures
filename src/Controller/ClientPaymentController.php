<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\ClientPayment;
use App\Form\ClientPaymentType;
use App\Repository\BookingRepository;
use App\Repository\ClientPaymentRepository;
use App\Repository\SupplierInformationRepository;
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
    public function new(
        Request $request,
        Booking $booking,
        EntityManagerInterface $entityManager,
        ClientPaymentRepository $clientPaymentRepo
    ): Response {
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

        return $this->renderForm('accordion/client_payment/new.html.twig', [
            'booking' => $booking,
            'client_payments' => $clientPaymentRepo->findBy(['booking' => $booking->getId()]),
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
        EntityManagerInterface $entityManager,
        Booking $booking
    ): Response {
        $form = $this->createForm(ClientPaymentType::class, $clientPayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'client_payment_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('accordion/client_payment/edit.html.twig', [
            'booking' => $booking,
            'client_payment' => $clientPayment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{booking_id}/client_payment/{client_payment_id}/delete", name="delete", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("clientPayment",options={"mapping": {"client_payment_id": "id"}})
     */
    public function delete(
        Request $request,
        ClientPayment $clientPayment,
        EntityManagerInterface $entityManager,
        BookingRepository $bookingRepository,
        SupplierInformationRepository $supplierInfoRepo,
        Booking $booking
    ): Response {
        // Initialisation of $ref (previous route variable)
        $ref = null;
        // Getting previous url
        $referer = $request->headers->get('referer');
        // Getting previous route
        if (is_string($referer)) {
            $ref = Request::create($referer)->getPathInfo();
        }

        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $clientPayment->getId(), $request->request->get('_token'))) {
                $entityManager->remove($clientPayment);
                $entityManager->flush();
            }
        }

        // Redirection depending on previous route
        if ($ref == '/') {
            return $this->redirectToRoute(
                'booking_index',
                [
                    'bookings' => $bookingRepository->findAll(),
                    'supplier_informations' => $supplierInfoRepo->findAll(),
                ],
                Response::HTTP_SEE_OTHER
            );
        }
        return $this->redirectToRoute(
            'client_payment_new',
            ['booking_id' => $booking->getId()],
            Response::HTTP_SEE_OTHER
        );
    }
}
