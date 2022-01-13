<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function paymentIndex(BookingRepository $bookingRepository): Response
    {
        return $this->render('dashboard/trip_index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
            'currentTrips' => $bookingRepository->findBy(['departure' => '']),
        ]);
    }
}
