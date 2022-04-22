<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\Reservation;
use App\Form\FormationType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="app_formation")
     */
    public function index(): Response
    {
        $formation=$this->getDoctrine()->getManager()->getRepository()->findAll();
        return $this->render('formation/index.html.twig', ['f'=>$formation]);
    }

    ## Ajout formation
    /**
     * @Route("/newformation", name="newformation")
     */
    public function newformation(Request $request): Response
    {
        $formation = new Formation();
        $formation->setIduser($this->getUser());
        $form= $this->createForm(Formationtype::class,$formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($formation); // ajout
            $em->flush();
            return $this->redirectToRoute('app_formation');
        }
        return $this->render('formation/newformation.html.twig',['f'=>$form->createView()]);
    }

    ## Modifier formation
    /**
     * @Route("/editformation/{idFormation}", name="editformation")
     */
    public function editformation ($idFormation,Request $request, FormationRepository $formationRepository)
    {
        $formation=$$formationRepository-›find($idFormation);
        $form=$this-›createForm(FormationType::class,$formation);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            Sem->flush();
            return $this-›redirectToRoute('profile');
        }
        return $this-›render('formation/editformation.html.twig',['f'=>$form->createView()]);
    }

## Supprimer formation
    /**
     * @Route("/deleteformation/{idFormation}", name="deleteformation")
     */
    public function deleteformation($idformation,FormationRepository $repository)
    {
        $formation = $repository->find($idformation);
        $em = $this - ›getDoctrine()->getManager();
        $em->remove($formation);
        Sem->fLush();
    return $this-›redirectToRoute('profile');
    }



}
