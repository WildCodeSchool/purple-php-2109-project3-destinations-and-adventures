<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/booking/", name="client_")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("client/", name="index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

     /**
     * @Route("client/{id}/delete", name="delete", methods={"POST", "GET"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        if (is_string($request->request->get('_token'))) {
            if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
                $entityManager->remove($client);
                $entityManager->flush();
            }
        }
        return $this->redirectToRoute('client_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("client/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Client $client, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
