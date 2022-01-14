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
     * @Route("payment/", name="payment", methods={"GET", "POST"})
     */
    public function paymentIndex(BookingRepository $bookingRepository): Response
    {
        return $this->render('dashboard/payment_index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
        ]);
    }
}
