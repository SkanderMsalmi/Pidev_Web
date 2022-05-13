<?php

namespace App\Controller;

use App\Entity\Demandestage;
use App\Form\DemandestageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Repository\UserRepository;
use App\Repository\StageRepository;
use App\Entity\Stage;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\DemandeStageRepository;
use MessageBird\Objects\Message;
use MessageBird\Objects\PartnerAccount\AccessKey;
use MessageBird\Client;

//use Symfony\Component\HttpKernel\Client;
//use Symfony\Component\BrowserKit\Client;
//use Symfony\Bundle\FrameworkBundle\Client;

/**
 * @Route("/demandestage")
 */
class DemandestageController extends AbstractController
{
    /**
     * @Route("/", name="app_demandestage_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $demandestages = $entityManager
            ->getRepository(Demandestage::class)
            ->findAll();

        return $this->render('demandestage/index.html.twig', [
            'demandestages' => $demandestages,
        ]);
    }

    /**
     * @Route("/indexx/{idpersonne}", name="app_demandestage_indexx", methods={"GET"})
     */
    public function indexx(EntityManagerInterface $entityManager,$idpersonne,UserRepository $rep1): Response
    {
        $p=$rep1->find($idpersonne);
        $demandestages = $entityManager
            ->getRepository(Demandestage::class)
            ->findByIduser($p);

        return $this->render('demandestage/indexetudiant.html.twig', [
            'demandestages' => $demandestages,
        ]);
    }

        /**
     * @Route("/indexxR/{idpersonne}", name="app_demandestage_indexxR", methods={"GET"})
     */
    public function indexxR(EntityManagerInterface $entityManager,$idpersonne,UserRepository $rep1): Response
    {   

        $p=$rep1->find($idpersonne);
        $stages=$entityManager->getRepository(Stage::class)->ListStageByIdPersonne($p);
        $demandestage1=[];
        foreach ($stages as $s) {
            $demandestages = $entityManager
            ->getRepository(Demandestage::class)
            ->findByidstage($s->getIdstage());
            foreach ($demandestages as $ds ) {
                array_push($demandestage1,$ds);
            }
        }

        

        return $this->render('demandestage/index.html.twig', [
            'demandestages' => $demandestage1,
        ]);
    }


    

    /**
     * @Route("/{id}/new", name="app_demandestage_new", methods={"GET", "POST"})
     *
     */
    public function new(Request $request, EntityManagerInterface $entityManager,$id,UserRepository $rep1,StageRepository $rep2,MailerInterface $mailer): Response
    {
        $demandestage = new Demandestage();
        $personne = $rep1->find($this->getUser()->getId());
        $stage= $rep2->find($id);
        $demandestage->setIdstage($stage);
        $demandestage->setIduser($personne);
        $demandestage->setEtat("En_attente");

            $entityManager->persist($demandestage);
            $entityManager->flush();

            $email = (new Email())
                ->from('chalouah.abdeladhim@esprit.tn')
                ->to('chalouah.abdeladhim@esprit.tn')


                ->subject(' Demande De Stage ')

                ->text('🥳 Vous Avez Recu Nouvelle Demande De Stage 🥳');

            $mailer->send($email);


        //    $client = new \MessageBird\Client('PYQDgLTrjUo26qnw6QPakZyl6');
          //  $message = new \MessageBird\Objects\Message();;

            /*$message->originator='Mon Stage';
            $message->recipients=['+21650890060'];
            $message->body ='🥳Vous Avez Recu Une Nouvelle Demande De Stage🥳';
            $client->messages->create($message);
*/
            return $this->redirectToRoute('app_demandestage_indexx', ['idpersonne' => $this->getUser()->getId()], Response::HTTP_SEE_OTHER);

    }

    /**
     * @Route("/{iddemande}", name="app_demandestage_show", methods={"GET"})
     */
    public function show(DemandeStageRepository $rep1,$iddemande): Response
    {
        $demandestage=$rep1->find($iddemande);
        return $this->render('demandestage/show.html.twig', [
            'demandestage' => $demandestage,
        ]);
    }
      /**
     * @Route("/{iddemande}/showe", name="app_demandestage_showe", methods={"GET"})
     */
    public function showe(DemandeStageRepository $rep1,$iddemande): Response
    {
        $demandestage=$rep1->find($iddemande);
        return $this->render('demandestage/showe.html.twig', [
            'demandestage' => $demandestage,
        ]);
    }
    /**
     * @Route("/{iddemande}/edit", name="app_demandestage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request,DemandeStageRepository $rep1,$iddemande, EntityManagerInterface $entityManager): Response
    {
        $demandestage=$rep1->find($iddemande);
        $form = $this->createForm(DemandestageType::class, $demandestage);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demandestage_indexxR', ['idpersonne'=> $this->getUser()->getid()], Response::HTTP_SEE_OTHER);

          
            
        }

        return $this->render('demandestage/edit.html.twig', [
            'demandestage' => $demandestage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iddemande}", name="app_demandestage_delete", methods={"POST"})
     */
    public function delete(Request $request,DemandeStageRepository $rep1,$iddemande, EntityManagerInterface $entityManager): Response
    {
        $demandestage=$rep1->find($iddemande);
        if ($this->isCsrfTokenValid('delete'.$demandestage->getIddemande(), $request->request->get('_token'))) {
            $entityManager->remove($demandestage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demandestage_indexxR', ['idpersonne'=> "1"], Response::HTTP_SEE_OTHER);
    }

      /**
     * @Route("/{iddemande}/deletee", name="app_demandestage_deletee", methods={"POST"})
     */
    public function deletee(Request $request,DemandeStageRepository $rep1,$iddemande, EntityManagerInterface $entityManager): Response
    {
        $demandestage=$rep1->find($iddemande);
        if ($this->isCsrfTokenValid('delete'.$demandestage->getIddemande(), $request->request->get('_token'))) {
            $entityManager->remove($demandestage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demandestage_indexx', ['idpersonne'=> "105"], Response::HTTP_SEE_OTHER);
    }
}
