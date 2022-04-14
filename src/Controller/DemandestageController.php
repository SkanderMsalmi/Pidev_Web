<?php

namespace App\Controller;

use App\Entity\Demandestage;
use App\Form\DemandestageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PersonneRepository;
use App\Repository\StageRepository;

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
     * @Route("/new", name="app_demandestage_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager,$idstage,PersonneRepository $rep1,StageRepository $rep2): Response
    {
        $demandestage = new Demandestage();
        $personne = $rep1->find(105);
        
        //$stage= $rep2->find($idstage);
        echo $idstage;
        $demandestage->setIdstage($idstage);
        $demandestage->setIdpersonne($personne);
      //  $form = $this->createForm(DemandestageType::class, $demandestage);
       // $form->handleRequest($request);
        $demandestage->setEtat("En_attente");

       // if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandestage);
            $entityManager->flush();

            return $this->redirectToRoute('app_demandestage_index', [], Response::HTTP_SEE_OTHER);
     //   }

        return $this->render('demandestage/new.html.twig', [
            'demandestage' => $demandestage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iddemande}", name="app_demandestage_show", methods={"GET"})
     */
    public function show(Demandestage $demandestage): Response
    {
        return $this->render('demandestage/show.html.twig', [
            'demandestage' => $demandestage,
        ]);
    }

    /**
     * @Route("/{iddemande}/edit", name="app_demandestage_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Demandestage $demandestage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandestageType::class, $demandestage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demandestage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demandestage/edit.html.twig', [
            'demandestage' => $demandestage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{iddemande}", name="app_demandestage_delete", methods={"POST"})
     */
    public function delete(Request $request, Demandestage $demandestage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandestage->getIddemande(), $request->request->get('_token'))) {
            $entityManager->remove($demandestage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demandestage_index', [], Response::HTTP_SEE_OTHER);
    }
}
