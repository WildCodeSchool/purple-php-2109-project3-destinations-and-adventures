<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Booking;
use App\Form\GeneralInfoType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/general", name="general_")
 */
class GeneralInfoController extends AbstractController
{
    /**
     * @Route("/info", name="info")
     */
    public function index(): Response
    {
        return $this->render('general_info/index.html.twig', [
            'controller_name' => 'GeneralInfoController',
        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $booking = new Booking();

        $form = $this->createForm(GeneralInfoType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();
            return $this->redirectToRoute('booking_index');
        }

        return $this->render('general/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
