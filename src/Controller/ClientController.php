<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FormType;
use App\Form\ClientType;

/**
 * @Route("/client", name="client_")
 */

class ClientController extends AbstractController
{
   /**
    * @Route("/new", name="new")
    */
    public function new(Request $request): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();
            return $this->redirectToRoute('clientPayment_edit');
        }
        return $this->render('client/new.html.twig', ["client" => $form->createView()]);
    }

    /**
     * @Route("/deleteClient", name="deleteClient")
     */
    public function delete(Request $request): Response
    {
        $delete = new Client();
        $form = $this->createForm(ClientType::class, $delete);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine() ->getManager();
            $entityManager->persist($delete);
            $entityManager->flush();
            return $this->redirectToRoute('new');
        }
        return $this->render('client/deleteClient.html.twig', ["client" => $form->createView()]);
    }
}
