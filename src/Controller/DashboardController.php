<?php

namespace App\Controller;

use App\Form\DaysType;
use App\Repository\BookingRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dashboard/", name="dashboard_")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("trip/", name="trip", methods={"GET", "POST"})
     */
    public function paymentIndex(BookingRepository $bookingRepository, Request $request): Response
    {
        $form = $this->createForm(DaysType::class);
        $form->handleRequest($request);
        $days = ['days' => 7];
        if ($form->isSubmitted()) {
            if (
                $form->getData() === ['days' => 7]
                || $form->getData() === ['days' => 14]
                || $form->getData() === ['days' => 21]
            ) {
                $days = $form->getData();
            }
        }
        return $this->renderForm('dashboard/trip_index.html.twig', [
            'form' => $form,
            'days' => $days,
            'upcomingTrips' => $bookingRepository->findUpcommingTrips($days["days"]),
            'currentTrips' => $bookingRepository->findCurrentTrips(),
            'returnedTrips' => $bookingRepository->findReturnedTrips(),
        ]);
    }
}
