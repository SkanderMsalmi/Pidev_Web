<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Reservation;
use App\Form\FormationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="app_reservation")
     */
    public function index(): Response
    {
        $reservation=$this->getDoctrine()->getManager()->getRepository()->findAll();
        return $this->render('reservation/index.html.twig', ['f'=>$reservation]);
    }

    ## Ajout formation
    /**
     * @Route("/newreservation", name="newreservation")
     */
    public function newreservation(Request $request): Response
    {
        $reservation = new Reservation();
        $reservation->setIduser($this->getUser());
        $form= $this->createForm(Reservationtype::class,$reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($reservation); // ajout reservation
            $em->flush();
            return $this->redirectToRoute('app_reservation');
        }
        return $this->render('formation/newformation.html.twig',['f'=>$form->createView()]);
    }



    ## Modifier reservation
    /**
     * @Route("/editreservation/{idReservation}", name="editformation")
     */
    public function editreservation ($idreservation,Request $request, ReservationRepository $reservationRepository)
    {
        $reservation=$reservationRepository-›find($idreservation);
        $form=$this-›createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            Sem->flush();
            return $this-›redirectToRoute('profile');
        }
        return $this-›render('reservation/editreservation.html.twig',['f'=>$form->createView()]);
    }



 ## Supprimer reservation
    /**
     * @Route("/deletereservation/{idReservation}", name="deletereservation")
     */
    public function deletereservation($idreservation,ReservationRepository $repository)
    {
        $reservation = $repository->find($idreservation);
        $em = $this - ›getDoctrine()->getManager();
        $em->remove($reservation);
        Sem->fLush();
        return $this-›redirectToRoute('profile');
    }


}
