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
                'financial_edit',
                ['booking_id' => $booking->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('generalInformation/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}/delete", name="delete", methods={"GET", "POST"})
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
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
      }

     /**
      * @Route("{id}/edit", name="edit")
      */
     public function edit(Request $request, Booking $booking, EntityManagerInterface $entityManager): Response
     {
         $form = $this->createForm(GeneralInfoType::class, $booking);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager->flush();

             return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
         }
         return $this->renderForm('generalInformation/edit.html.twig', [
             'booking' => $booking,
             'form' => $form,
         ]);
     }
}
