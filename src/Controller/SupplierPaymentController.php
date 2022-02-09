<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\SupplierPayment;
use App\Form\SupplierPaymentType;
use App\Repository\BookingRepository;
use App\Repository\SupplierPaymentRepository;
use App\Repository\SupplierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/", name="supplier_payment_",)
 */
class SupplierPaymentController extends AbstractController
{
    /**
     * @Route("{booking_id}/supplier_payment/new", name="new", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function new(
        Request $request,
        Booking $booking,
        EntityManagerInterface $entityManager,
        SupplierPaymentRepository $suppPayRepo
    ): Response {
        $supplierPayment = new SupplierPayment();
        $form = $this->createForm(SupplierPaymentType::class, $supplierPayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supplierPayment->setBooking($booking);
            $entityManager->persist($supplierPayment);
            $entityManager->flush();

            return $this->redirectToRoute(
                'supplier_payment_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('accordion/supplier_payment/new.html.twig', [
            'supplier_payments' => $suppPayRepo->findBy(['booking' => $booking->getId()]),
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    /**
     * @Route("{booking_id}/supplier_payment/{supplierPayment_id}/edit", name="edit", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("supplierPayment", options={"mapping": {"supplierPayment_id": "id"}})
     */
    public function edit(
        Request $request,
        Booking $booking,
        EntityManagerInterface $entityManager,
        SupplierPayment $supplierPayment
    ): Response {
        $form = $this->createForm(SupplierPaymentType::class, $supplierPayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'supplier_payment_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('accordion/supplier_payment/edit.html.twig', [
            'booking' => $booking,
            'supplier_payment' => $supplierPayment,
            'form' => $form,
        ]);
    }

    /**
     * @Route("{booking_id}/supplier_payment/{supplier_payment_id}", name="delete", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("supplierPayment", options={"mapping": {"supplier_payment_id": "id"}})
     */
    public function delete(
        Request $request,
        SupplierPayment $supplierPayment,
        EntityManagerInterface $entityManager,
        BookingRepository $bookingRepository,
        SupplierRepository $supplierInfoRepo,
        Booking $booking
    ): Response {
        // Initialization of $ref (previous route variable)
        $ref = null;
        // Getting previous url
        $referer = $request->headers->get('referer');
        // Getting previous route
        if (is_string($referer)) {
            $ref = Request::create($referer)->getPathInfo();
        }

        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $supplierPayment->getId(), $request->request->get('_token'))) {
                $entityManager->remove($supplierPayment);
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
            'supplier_payment_new',
            ['booking_id' => $booking->getId()],
            Response::HTTP_SEE_OTHER
        );
    }
}
