<?php
namespace App\Controller;
use App\Entity\Reservation;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\FormationRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
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
     * @Route("/admin/reservation", name="app_reservation", methods={"GET"})
     */
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


## lel etudiant
    /**
     * @Route("/reservationEtudiant", name="app_reservation_Etudiant", methods={"GET"})
     */
    public function reservationEtudiant(ReservationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $reservation = $paginator->paginate(
            $reservation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );
        return $this->render('reservation/reservationEtudiant.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation'=> $reservation
        ]);
    }

### lel formateur
    /**
     * @Route("/reservationFormateur", name="app_reservation_Formateur", methods={"GET"})
     */
    public function reservationFormateur(ReservationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $reservation = $paginator->paginate(
            $reservation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );
        return $this->render('reservation/reservationFormateur.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation'=> $reservation
        ]);
    }


    ### lel admin
    /**
     * @Route("/admin/reservationAdmin", name="app_reservation_Admin", methods={"GET"})
     */
    public function reservationAdmin(ReservationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $reservation = $paginator->paginate(
            $reservation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );
        return $this->render('reservation/reservationAdmin.html.twig', [
            'controller_name' => 'ReservationController',
            'reservation'=> $reservation
        ]);
    }

# ajout reservation etudiant
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
            $this->addFlash('success','Reservation ajoutée avec sucées');
            return $this->redirectToRoute('reservationEtudiant', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('reservation/newreservation.html.twig', [
            'formation' => $reservation,
            'f' => $form->createView(),
        ]);
    }



##Modifier reservation
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
            $this->addFlash('success','Reservation modifier avec sucées');
            return $this->redirectToRoute('app_reservation');
        }
        return $this->render('reservation/editreservation.html.twig',['ff'=>$form->createView()]);
    }
##Supprimer reservation
    /**
     * @Route("/deletereservation/{idreservation}", name="deletereservation")
     */
    public function deletereservation($idreservation,ReservationRepository $repository)
    {
        $reservation = $repository->find($idreservation);
        $em=$this->getDoctrine()->getManager();
        $em->remove($reservation);
        $em->fLush();
        $this->addFlash('success','Reservation supprimer avec sucées');
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
######## PDF
    /**
     * @Route("/DownloadProduitsDataReservation", name="DownloadProduitsDataReservation")
     */
    public function DownloadProduitsDataReservation(ReservationRepository $repository)
    {
        $produits=$repository->findAll();

        // On définit les options du PDF
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('reservation/download.html.twig',
            ['produits'=>$produits ]);


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'Tableau des Produits.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
    }

}
