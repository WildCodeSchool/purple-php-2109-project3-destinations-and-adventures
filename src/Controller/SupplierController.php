<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/booking/", name="supplier_"")
 */
class SupplierController extends AbstractController
{
    /**
     * @Route("supplier/", name="index", methods={"GET"})
     */
    public function index(SupplierRepository $supplierRepository): Response
    {
        return $this->render('supplier/index.html.twig', [
            'suppliers' => $supplierRepository->findAll(),
        ]);
    }
}
