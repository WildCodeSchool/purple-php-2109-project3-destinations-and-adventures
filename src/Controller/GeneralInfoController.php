<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Booking;
use App\Form\GeneralInfoType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/general-informations/", name="general_")
 */
class GeneralInfoController extends AbstractController
{
    /**
     * @Route("new", name="new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $booking = new Booking();

        $form = $this->createForm(GeneralInfoType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($booking);
            $entityManager->flush();
            return $this->redirectToRoute(
                'agent_new',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('accordion/generalInformation/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("{booking_id}/delete", name="delete", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function delete(
        Request $request,
        Booking $booking,
        EntityManagerInterface $entityManager
    ): Response {
        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $booking->getId(), $request->request->get('_token'))) {
                $entityManager->remove($booking);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('booking_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("{booking_id}/edit", name="edit")
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function edit(Request $request, Booking $booking, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GeneralInfoType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('accordion/generalInformation/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }
}
