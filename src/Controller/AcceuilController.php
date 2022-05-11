<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/", name="acceuil")
     */
    public function index(): Response
    {
        return $this->render('acceuil/acceuil.html.twig', [
            'controller_name' => 'AcceuilController',
        ]);
    }
    
    /**
     * @Route("/404", name="erreur")
     */
    public function FunctionName(): Response
    {
        return $this->render('pages-error-404.html.twig', []);
    }
}
