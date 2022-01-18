<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\Agent1Type;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/agent", name="agent_")
 */
class AgentController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="index", methods={"GET", "POST"})
     */
    public function index(AgentRepository $agentRepository): Response
    {
        return $this->render('agent/index.html.twig', [
            'agents' => $agentRepository->findAll(),
        ]);
    }
}
