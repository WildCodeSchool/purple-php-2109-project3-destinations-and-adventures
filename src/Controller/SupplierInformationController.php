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

        return $this->renderForm('supplier_information/new.html.twig', [
            'supplier_informations' => $suppInfoRepo->findBy(['booking' => $booking->getId()]),
            'form' => $form,
        ]);
    }
}
