<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\SupplierInformation;
use App\Form\SupplierInformationType;
use App\Repository\SupplierInformationRepository;
use App\Repository\SupplierPaymentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/", name="supplier_information_",)
 */
class SupplierInformationController extends AbstractController
{

    /**
     * @Route("{booking_id}/supplier_information/new", name="new", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function new(
        Request $request,
        Booking $booking,
        EntityManagerInterface $entityManager,
        SupplierInformationRepository $suppInfoRepo
    ): Response {
        $supplierInformation = new SupplierInformation();
        $form = $this->createForm(SupplierInformationType::class, $supplierInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $supplierInformation->setBooking($booking);
            $entityManager->persist($supplierInformation);
            $entityManager->flush();

            return $this->redirectToRoute(
                'supplier_information_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('accordion/supplier_information/new.html.twig', [
            'supplier_informations' => $suppInfoRepo->findBy(['booking' => $booking->getId()]),
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    /**
     * @Route("{booking_id}/supplier_information/{supplier_information_id}/edit", name="edit", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("supplierInformation", options={"mapping": {"supplier_information_id": "id"}})
     */
    public function edit(
        Request $request,
        Booking $booking,
        SupplierInformation $supplierInformation,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(SupplierInformationType::class, $supplierInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'supplier_information_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('accordion/supplier_information/edit.html.twig', [
            'supplier_information' => $supplierInformation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("{booking_id}/supplier_information/{supplier_information_id}", name="delete", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("supplierInformation", options={"mapping": {"supplier_information_id": "id"}})
     */
    public function delete(
        Request $request,
        SupplierInformation $supplierInformation,
        EntityManagerInterface $entityManager,
        Booking $booking
    ): Response {
        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $supplierInformation->getId(), $request->request->get('_token'))) {
                $entityManager->remove($supplierInformation);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute(
            'supplier_information_new',
            ['booking_id' => $booking->getId()],
            Response::HTTP_SEE_OTHER
        );
    }
}
