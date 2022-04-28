<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\PropertySearch;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use Knp\Component\Pager\PaginatorInterface;



class FormationController extends AbstractController
{
    /**
     * @Route("/formation", name="app_formation", methods={"GET"})
     */

    public function index(FormationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $formation = $paginator->paginate(
            $formation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );

        return $this->render('formation/index.html.twig', [
            'f' => $formation,
        ]);
    }



    ## Ajout formation
    /**
     * @Route("/newformation", name="newformation")
     */
    public function newformation(Request $request): Response
    {
        $formation = new Formation();
        #$formation->setIduser($this->getUser());
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
    #@Route("/editformation/{idFormation}", name="editformation", methods={"GET", "POST"})
    /**
     *
     * @Route("/edit/{idFormation}", name="editformation", methods={"GET", "POST"})
     */
    public function editformation ($idFormation, Request $request, FormationRepository $formationRepository):Response
    {
        $formation = $formationRepository->find($idFormation);
        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_formation');
            # kenet profile : app_reservation_index
        }
        return $this->render('formation/editformation.html.twig',['ff'=>$form->createView()]);
    }

## Supprimer formation
    /**
     * @Route("/deleteformation/{idFormation}", name="deleteformation")
     */
    public function deleteformation($idFormation,FormationRepository $repository)
    {
        $formation = $repository->find($idFormation);
        $em = $this ->getDoctrine()->getManager();
        $em->remove($formation);
        $em->fLush();
        return $this->redirectToRoute('app_formation');

    }



    /**
     * @Route("/formation/{idFormation}", name="app_formation_show", methods={"GET"})
     */
    public function show(EntityManagerInterface $entityManager, $idFormation): Response
    {
        $formation = $entityManager
            ->getRepository(Formation::class)
            ->find($idFormation);

        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

}
