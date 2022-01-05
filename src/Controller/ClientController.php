<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FormType;
use App\Form\ClientType;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/client", name="new_")
 */

class ClientController extends AbstractController
{
   /**
    * @Route("/client", name="new")
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
     * @Route("/modifyClient", name="modifyClient")
     */
    public function edit(Request $request): Response
    {
        $modify = new Client();
        $form = $this->createForm(ClientType::class, $modify);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine() ->getManager();
            $entityManager->persist($modify);
            $entityManager->flush();
            return $this->redirectToRoute('new');
        }
        return $this->render('client/modifyClient.html.twig', ["client" => $form->createView()]);
    }
}
