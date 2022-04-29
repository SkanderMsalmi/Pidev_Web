<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\FormationRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Knp\Component\Pager\PaginatorInterface;


class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="app_reservation", methods={"GET"})
     */
    #public function index(): Response
    #{
    #   $reservation=$this->getDoctrine()->getManager()->getRepository()->findAll();
    #   return $this->render('reservation/index.html.twig', ['f'=>$reservation]);
    #}

    public function index(ReservationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $reservation = $paginator->paginate(
            $reservation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation'=> $reservation
        ]);
    }


    /**
     * @Route("/newreservation", name="newreservation", methods={"GET", "POST"})
     */
    public function newreservation(Request $request, EntityManagerInterface $entityManager,UserRepository $userRepository,ReservationRepository $reservationRepository): Response
    {

        $reservation = new Reservation();

        #$user=$userRepository->find(1);#
        #$reservation->setIduser($user);#

        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('reservation/newreservation.html.twig', [
            'formation' => $reservation,
            'f' => $form->createView(),
        ]);
    }






    ## Modifier reservation
    #@Route("/editreservation/{idReservation}", name="editreservation")
    /**
     *  @Route("/editreservation/{idreservation}", name="editreservation", methods={"GET", "POST"})
     */
    public function editreservation ($idreservation,Request $request, ReservationRepository $reservationRepository)
    {
        $reservation=$reservationRepository->find($idreservation);
        $form=$this->createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_reservation');
        }
        return $this->render('reservation/editreservation.html.twig',['ff'=>$form->createView()]);
    }


 ## Supprimer reservation
    /**
     * @Route("/deletereservation/{idreservation}", name="deletereservation")
     */
    public function deletereservation($idreservation,ReservationRepository $repository)
    {
        $reservation = $repository->find($idreservation);
        $em=$this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->fLush();
        return $this->redirectToRoute('app_reservation');
    }




    /**
     * @Route("/reservation/{idreservation}", name="app_reservation_show", methods={"GET"})
     */
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * @Route("/sendmail")
     */

    function mailing(MailerInterface $mailer, $idreservation)
    {
        $repo = $this->getDoctrine()->getRepository(Reservation::class);
        $reservation = $repo->findOneBy(['id' => $idreservation]);


        $email = (new Email())
            ->from('pidevsymfonymail@gmail.com')
            ->to($reservation->getIduser()->getEmail())
            ->subject('Reservation')
            ->text('Votre reservation est confirme !');


        $mailer->send($email);
        return $this->redirectToRoute('app_reservation');
    }


}
