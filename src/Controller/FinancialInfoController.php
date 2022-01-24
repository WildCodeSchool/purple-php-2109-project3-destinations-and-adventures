<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\FinancialInfoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/", name="financial_")
 */
class FinancialInfoController extends AbstractController
{
    /**
     * @Route("{booking_id}/financial-informations/edit", name="edit")
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function edit(Request $request, Booking $booking, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FinancialInfoType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'client_payment_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('accordion/financial_info/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }
}
