<?php

namespace App\Controller;

use App\Entity\Competance;
use App\Form\CompetanceType;
use App\Repository\CompetanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetanceController extends AbstractController
{
    /**
     * @Route("/competance", name="app_competance")
     */
    public function index(): Response
    {
        $competances = $this->getDoctrine()->getManager()->getRepository()->findAll();
        return $this->render('competance/index.html.twig', [
            'competances' => $competances,
        ]);
    }
    /**
     * @Route("/addCompetance", name="add_competance")
     */
    public function addCompetance(Request $request):Response{
        $competance = new Competance();
        $competance->setIdUser($this->getUser());
        $compForm = $this->createForm(CompetanceType::class,$competance);
        $compForm->handleRequest($request);
        if($compForm->isSubmitted() && $compForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($competance);
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('competance/addCompetance.html.twig',[
            'f'=>$compForm->createView()
        ]);
    }
    /**
     * @Route("/editCompetance/{idCompetance}", name="edit_competance")
     */
    public function editCompetance($idCompetance,Request $request,CompetanceRepository $competanceRepository){
        $competance = $competanceRepository->find($idCompetance);
        $compForm = $this->createForm(CompetanceType::class,$competance);
        $compForm->handleRequest($request);
        if($compForm->isSubmitted() && $compForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('competance/editCompetance.html.twig',[
            'f'=>$compForm->createView()
        ]);
    }

    /**
     * @Route("/suppCompetance/{idCompetance}", name="supp_competance")
     */
    public function supprimerCompetence( $idCompetance,CompetanceRepository $repository){
        $competance = $repository->find($idCompetance);
        $em = $this->getDoctrine()->getManager();
        $em->remove($competance);
        $em->flush();

        return $this->redirectToRoute('profile');
    }
}
