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
use App\Repository\PersonneRepository;
use App\Repository\StageRepository;
use App\Entity\Stage;
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
    public function indexx(EntityManagerInterface $entityManager): Response
    {
        $demandestages = $entityManager
            ->getRepository(Demandestage::class)
            ->findByIdpersonne(105);

        return $this->render('demandestage/indexetudiant.html.twig', [
            'demandestages' => $demandestages,
        ]);
    }

        /**
     * @Route("/indexxR/{idpersonne}", name="app_demandestage_indexxR", methods={"GET"})
     */
    public function indexxR(EntityManagerInterface $entityManager): Response
    {
        $demandestages = $entityManager
            ->getRepository(Demandestage::class)
            ->findByIdpersoneeRec(107);

        return $this->render('demandestage/index.html.twig', [
            'demandestages' => $demandestages,
        ]);
    }


    

    /**
     * @Route("/{id}/new", name="app_demandestage_new", methods={"GET", "POST"})
     *
     */
    public function new(Request $request, EntityManagerInterface $entityManager,Stage $stage,PersonneRepository $rep1,StageRepository $rep2): Response
    {
        $demandestage = new Demandestage();
        $personne = $rep1->find(105);
        $demandestage->setIdstage($stage);
        $demandestage->setIdpersonne($personne);
        $demandestage->setEtat("En_attente");

            $entityManager->persist($demandestage);
            $entityManager->flush();

            return $this->redirectToRoute('app_demandestage_index', [], Response::HTTP_SEE_OTHER);

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
     * @Route("/{iddemande}/showe", name="app_demandestage_showe", methods={"GET"})
     */
    public function showe(Demandestage $demandestage): Response
    {
        return $this->render('demandestage/showe.html.twig', [
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

            return $this->redirectToRoute('app_demandestage_indexxR', ['idpersonne'=> "105"], Response::HTTP_SEE_OTHER);

          
            
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

        return $this->redirectToRoute('app_demandestage_indexxR', ['idpersonne'=> "105"], Response::HTTP_SEE_OTHER);
    }

      /**
     * @Route("/{iddemande}/deletee", name="app_demandestage_deletee", methods={"POST"})
     */
    public function deletee(Request $request, Demandestage $demandestage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandestage->getIddemande(), $request->request->get('_token'))) {
            $entityManager->remove($demandestage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demandestage_indexx', ['idpersonne'=> "105"], Response::HTTP_SEE_OTHER);
    }
}
