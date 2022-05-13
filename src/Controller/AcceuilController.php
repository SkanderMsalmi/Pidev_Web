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
        $user=$this->getUser();
        if($this->getUser()){
            if($user->getRoles()[0] == "ROLE_ADMIN"){
                return $this->redirectToRoute('app_admin_users');
            }else {
                return $this->render('acceuil/acceuil.html.twig', [
                    'controller_name' => 'AcceuilController',
                ]);
            }
        }
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

        /**
     * @Route("/admin", name="erreur")
     */
    public function adminside(): Response
    {
        return $this->render('baseAdmin.html.twig', []);
    }
}
