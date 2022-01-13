<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\BookingRepository;
use App\Repository\SupplierInformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/booking", name="booking_")
 */
class BookingController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(
        BookingRepository $bookingRepository,
        SupplierInformationRepository $supplierInformationRepo
    ): Response {
        return $this->render('booking/index.html.twig', [
            'bookings' => $bookingRepository->findAll(),
            'supplier_informations' => $supplierInformationRepo->findAll(),
        ]);
    }
}
