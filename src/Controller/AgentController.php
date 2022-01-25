<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Entity\Booking;
use App\Form\AgentType;
use App\Form\AgencyType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AgentController extends AbstractController
{
    /**
     * @Route("/agent", name="agent_index", methods={"GET"})
     */
    public function index(AgentRepository $agentRepository): Response
    {
        return $this->render('agent/index.html.twig', [
            'agents' => $agentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/booking/{booking_id}/agent/new", name="agent_new", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     */
    public function new(Booking $booking, Request $request, EntityManagerInterface $entityManager): Response
    {
        $agent = new Agent();

        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agent->addBooking($booking);
            $entityManager->persist($agent);
            $entityManager->flush();

            return $this->redirectToRoute(
                'financial_edit',
                [
                'booking_id' => $booking->getId()
                ],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('accordion/agency/new.html.twig', [
            'form' => $form,
            'booking' => $booking,
        ]);
    }

    /**
     * @Route("/booking/{booking_id}/agency/{agent_id}/edit", name="agent_edit", methods={"GET", "POST"})
     * @ParamConverter("booking", options={"mapping": {"booking_id": "id"}})
     * @ParamConverter("agent", options={"mapping": {"agent_id": "id"}})
     */
    public function edit(
        Agent $agent,
        Request $request,
        Booking $booking,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'financial_edit',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('accordion/agency/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
            'agency' => $agent,
        ]);
    }

      /**
     * @Route("/agent/{agent_id}/delete", name="agent_delete", methods={"GET", "POST"})
     * @ParamConverter("agent", options={"mapping": {"agent_id": "id"}})
     */
    public function delete(
        Request $request,
        Agent $agent,
        EntityManagerInterface $entityManager
    ): Response {
        // Get the related bookings collection
        $bookings = $agent->getBookings();
        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $agent->getId(), $request->request->get('_token'))) {
                // Removing the booking attached to the agent (to get around constraint key error)
                foreach ($bookings as $booking) {
                    $entityManager->remove($booking);
                }
                $entityManager->remove($agent);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute(
            'agent_index',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}
