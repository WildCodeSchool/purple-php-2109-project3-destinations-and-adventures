<?php

namespace App\Controller;

use App\Form\DaysType;
use App\Repository\BookingRepository;
use App\Repository\ClientPaymentRepository;
use App\Repository\SupplierPaymentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/", name="dashboard_")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("payment/", name="payment", methods={"GET", "POST"})
     */
    public function paymentIndex(
        BookingRepository $bookingRepository,
        Request $request,
        ClientPaymentRepository $clientPaymentRepo,
        SupplierPaymentRepository $supplierPaymentRepo
    ): Response {
        $days = ['days' => 7];
        $clientPayments = $clientPaymentRepo->findIncommingClientPayments($days['days']);
        $supplierPayments = $supplierPaymentRepo->findOucommingSupplierPayments($days['days']);
        $supplierCommissions = $supplierPaymentRepo->findOucommingSupplierCommissions($days['days']);
        $agentCommissions = $bookingRepository->findAgentCommission($days['days']);
        $daiCommissions = $bookingRepository->findDaiCommission($days['days']);

        $form = $this->createForm(DaysType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (
                $form->getData() === ['days' => 7]
                || $form->getData() === ['days' => 15]
                || $form->getData() === ['days' => 30]
            ) {
                $days = $form->getData();
                $clientPayments = $clientPaymentRepo->findIncommingClientPayments($days['days']);
                $supplierPayments = $supplierPaymentRepo->findOucommingSupplierPayments($days['days']);
                $supplierCommissions = $supplierPaymentRepo->findOucommingSupplierCommissions($days['days']);
                $agentCommissions = $bookingRepository->findAgentCommission($days['days']);
                $daiCommissions = $bookingRepository->findDaiCommission($days['days']);
            } else {
                $clientPayments = $clientPaymentRepo->findAll();
                $supplierPayments = $supplierPaymentRepo->findAll();
                $supplierCommissions = $supplierPaymentRepo->findAll();
                $agentCommissions = $bookingRepository->findAll();
                $daiCommissions = $bookingRepository->findAll();
            }
        }
        return $this->renderForm('dashboard/payment_index.html.twig', [
            'form' => $form,
            'clientPayments' => $clientPayments,
            'supplierPayments' => $supplierPayments,
            'supplierCommissions' => $supplierCommissions,
            'agentCommissions' => $agentCommissions,
            'daiCommissions' => $daiCommissions,

        ]);
    }

    /**
     * @Route("trip/", name="trip", methods={"GET", "POST"})
     */
    public function tripIndex(BookingRepository $bookingRepository, Request $request): Response
    {
        $days = ['days' => 7];
        $upcomingTrips = $bookingRepository->findUpcommingTrips($days['days']);
        $returnedTrips = $bookingRepository->findReturnedTrips($days['days']);

        $form = $this->createForm(DaysType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (
                $form->getData() === ['days' => 7]
                || $form->getData() === ['days' => 15]
                || $form->getData() === ['days' => 30]
            ) {
                $days = $form->getData();
                $upcomingTrips = $bookingRepository->findUpcommingTrips($days['days']);
                $returnedTrips = $bookingRepository->findReturnedTrips($days['days']);
            } else {
                $upcomingTrips = $bookingRepository->findAll();
                $returnedTrips = $bookingRepository->findAll();
            }
        }
        return $this->renderForm('dashboard/trip_index.html.twig', [
            'form' => $form,
            'days' => $days,
            'upcomingTrips' => $upcomingTrips,
            'currentTrips' => $bookingRepository->findCurrentTrips(),
            'returnedTrips' => $returnedTrips
        ]);
    }
}
