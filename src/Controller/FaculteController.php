<?php

namespace App\Controller;

use App\Entity\Faculte;
use App\Form\FaculteType;
use App\Repository\FaculteRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FaculteController extends AbstractController
{
    /**
     * @Route("/faculte", name="app_faculte")
     */
    public function index(FaculteRepository $faculteRepository): Response
    {
        $facultes = $faculteRepository->findAll();
        return $this->render('faculte/index.html.twig', [
            'facultes' => $facultes,
        ]);
    }
    /**
     * @Route("/editfaculte/{idUser}", name="edit_faculte")
     */
    public function editFaculte($idUser,Request $request,FaculteRepository $faculteRepository,UserRepository $userRepository){

        $facForm = $this->createForm(FaculteType::class);
        $facForm->handleRequest($request);
        if($facForm->isSubmitted() && $facForm->isValid()){
            /*$userRepository->find($idUser)->setIdfaculte($faculte);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('profile');*/
            var_dump($request->get());
        }
        return $this->render('faculte/changeFaculte.html.twig',[
            'f'=>$facForm->createView()
        ]);
    }
}
