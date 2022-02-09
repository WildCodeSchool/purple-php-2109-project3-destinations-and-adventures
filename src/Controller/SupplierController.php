<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Supplier;
use App\Entity\SupplierPayment;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SupplierController extends AbstractController
{
    /**
     * @Route("/supplier/", name="supplier_index", methods={"GET"})
     */
    public function index(SupplierRepository $supplierRepository): Response
    {
        return $this->render('supplier/index.html.twig', [
            'suppliers' => $supplierRepository->findAll(),
        ]);
    }

    /**
     * @Route("/booking/{booking_id}/supplier/new", name="supplier_new", methods={"GET", "POST"})
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
            'booking' => $booking,
        ]);
    }

    /**
      * @Route("/supplier/{id}/edit", name="supplier_edit", methods={"GET", "POST"})
     */
    public function edit(
        Request $request,
        Supplier $supplier,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(SupplierType::class, $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'supplier_index',
                [],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('supplier/edit.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supplier/{id}/delete", name="supplier_delete", methods={"GET", "POST"})
     */
    public function delete(
        Request $request,
        Supplier $supplier,
        EntityManagerInterface $entityManager
    ): Response {
        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $supplier->getId(), $request->request->get('_token'))) {
                $entityManager->remove($supplier);
                $entityManager->flush();
            }
        }
            return $this->redirectToRoute('supplier_index', [], Response::HTTP_SEE_OTHER);
    }
}
