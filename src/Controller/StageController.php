<?php

namespace App\Controller;

use App\Entity\Stage;
use App\Form\StageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\StageRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/stage")
 */
class StageController extends AbstractController
{
    /**
     * @Route("/", name="app_stage_index", methods={"GET"})
     */
    public function index(Request $request,EntityManagerInterface $entityManager,StageRepository $repository, PaginatorInterface $paginator): Response
    {
        $stages = $paginator->paginate( $entityManager
            ->getRepository(Stage::class)
            ->findAll(),$request->query->getInt('page', 1),6 );
        $Info = $repository
        ->countByDomaine('Informatique'); 
        $Elec =$repository
        ->countByDomaine('Electronique'); 
        $Meca = $repository
        ->countByDomaine('Mécanique');
        $Ges =$repository
        ->countByDomaine('Gestion');
        $Eco = $repository
        ->countByDomaine('Economie'); 
        $Spo = $repository
        ->countByDomaine('Sport');
       
            $array[] = array('Informatique'=> $Info,
            'Electronique'=> $Elec,
            'Mecanique'=>$Meca,
            'Gestion'=>$Ges,
            'Economie'=>$Eco,
            'Sport'=>$Spo);

        return $this->render('stage/index.html.twig', [
            'stages' => $stages,
            'sport'=>$Spo,
            'eco'=>$Eco,
            'ges'=>$Ges,
            'meca'=>$Meca,
            'elec'=>$Elec,
            'info'=>$Info,
            //'array' => \json_encode($array),
            
        ]);
    }
     /**
     * @Route("/adminstage", name="app_stage_indexx", methods={"GET"})
     */
    public function indexx(EntityManagerInterface $entityManager): Response
    {
        
        $stages = $entityManager
        ->getRepository(Stage::class)
        ->findAll();

        return $this->render('stage/Adminstage.html.twig',
         [
             'stages' => $stages,
        ]);
    }

    /**
     * @Route("/new", name="app_stage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $repository): Response
    {
        $stage = new Stage();
        $personne = $repository->find(1);
        $stage->setIduser($personne);
        $stage->setDatefin(new \DateTime("2023-10-10"));
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($stage);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'Stage Ajouter Avec Succèe'

            );

            return $this->redirectToRoute('app_stage_mesStage', ['idpersonne' => "1"], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stage/new.html.twig', [
            'stage' => $stage,
            'f1' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idstage}/show", name="app_stage_show", methods={"GET","POST"})
     */
    public function show(Stage $stage): Response
    {
        
        return $this->render('stage/show.html.twig', [
            'stage' => $stage,
        ]);
    }
    

    /**
     * @Route("/{idstage}/edit", name="app_stage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Stage $stage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash(
                'info',
                'Stage Modifier Avec Succèe'

            );

            return $this->redirectToRoute('app_stage_mesStage', ['idpersonne' => "1"], Response::HTTP_SEE_OTHER);
        }

        return $this->render('stage/edit.html.twig', [
            'stage' => $stage,
            'f1' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idstage}/delete", name="app_stage_delete", methods={"POST","GET"})
     */
    public function delete(Request $request, Stage $stage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stage->getIdstage(), $request->request->get('_token'))) {
            $entityManager->remove($stage);
            $entityManager->flush();
            $this->addFlash(
                'info',
                'Stage supprimer Avec Succèe'

            );
        }

        return $this->redirectToRoute('app_stage_mesStage', ['idpersonne' => "1"], Response::HTTP_SEE_OTHER);
    }
    /**
     * @Route("/mesStage/{idpersonne}", name="app_stage_mesStage", methods={"GET", "POST"})
     */
   public function MesStages(Request $request,  PaginatorInterface $paginator)
   {
       
       $stage = $paginator->paginate( $this->getDoctrine()
       ->getRepository(Stage::class)
       ->ListStageByIdPersonne(1),$request->query->getInt('page', 1),6 );

        return $this-> render('stage/mesStage.html.twig',
        ['stage' => $stage]);
   }
    

}
