<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\SupplierPayment;
use App\Form\SupplierPaymentType;
use App\Repository\SupplierPaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/", name="supplier_payment_")
 */
class SupplierPaymentController extends AbstractController
{
    /**
     * @Route("{booking_id}/supplier_payment/index", name="index", methods={"GET"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function index(SupplierPaymentRepository $paymentRepository, Booking $booking): Response
    {
        return $this->render('supplier_payment/index.html.twig', [
            'supplier_payments' => $paymentRepository->findBy(['booking' => $booking->getId()]),
            'booking' => $booking,
        ]);
    }

    /**
     * @Route("{booking_id}/supplier_payment/{supplier_payment_id}/edit", name="edit", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("supplierPayment", options={"mapping": {"supplier_payment_id": "id"}})
     */
    public function edit(
        Request $request,
        Booking $booking,
        SupplierPayment $supplierPayment,
        EntityManagerInterface $entityManager,
        SupplierPaymentRepository $paymentRepository
    ): Response {
        $form = $this->createForm(SupplierPaymentType::class, $supplierPayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute(
                'supplier_payment_index',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }
        return $this->renderForm('supplier_payment/edit.html.twig', [
            'supplier_payments' => $paymentRepository->findBy(['booking' => $booking->getId()]),
            'form' => $form,
        ]);
    }

    /**
     * @Route("{booking_id}/supplier_payment/{supplier_payment_id}", name="delete", methods={"POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("supplierPayment", options={"mapping": {"supplier_payment_id": "id"}})
     */
    public function delete(
        Request $request,
        SupplierPayment $supplierPayment,
        EntityManagerInterface $entityManager,
        Booking $booking
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $supplierPayment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($supplierPayment);
            $entityManager->flush();
        }
        return $this->redirectToRoute(
            'supplier_payment_index',
            ['booking_id' => $booking->getId()],
            Response::HTTP_SEE_OTHER
        );
    }
}
