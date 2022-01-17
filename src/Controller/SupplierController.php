<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/", name="supplier_")
 */
class SupplierController extends AbstractController
{
    /**
     * @Route("supplier/", name="index", methods={"GET"})
     */
    public function index(SupplierRepository $supplierRepository): Response
    {
        return $this->render('supplier/index.html.twig', [
            'suppliers' => $supplierRepository->findAll(),
        ]);
    }

    /**
     * @Route("{booking_id}/supplier/new", name="new", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function new(Booking $booking, Request $request, EntityManagerInterface $entityManager): Response
    {
        $supplier = new Supplier();
        $form = $this->createForm(SupplierType::class, $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($supplier);
            $entityManager->flush();

            return $this->redirectToRoute('supplier_information_new', [
                'booking_id' => $booking->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supplier/new.html.twig', [
            'form' => $form,
        ]);
    }
}
