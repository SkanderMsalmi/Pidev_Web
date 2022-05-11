<?php

namespace App\Controller;

use App\Repository\SocieteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class SocieteController extends AbstractController
{
    /**
     * @Route("/societe", name="app_societe")
     */
    public function index(SocieteRepository $repository): Response
    {
        $societes = $repository->findAll();
        return $this->render('societe/index.html.twig', [
            'societes' => $societes,
        ]);
    }
}
