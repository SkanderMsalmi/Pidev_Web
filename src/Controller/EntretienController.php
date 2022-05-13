<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Entity\Stage;
use App\Form\Entretien1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\EntretienRepository;

/**
 * @Route("/entretien")
 */
class EntretienController extends AbstractController
{
    /**
     * @Route("/admin", name="app_entretien_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findAll();

        return $this->render('entretien/entretienAdmin.html.twig', [
            'entretiens' => $entretiens,
        ]);
    }
       /**
     * @Route("/indexx/{idpersonne}", name="app_entretien_indexx", methods={"GET"})
     */
    public function indexx(EntityManagerInterface $entityManager,$idpersonne,UserRepository $rep1): Response
    {
        $p=$rep1->find($idpersonne);

        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findByIduser($p);

        return $this->render('entretien/indexetudiant.html.twig', [
            'entretiens' => $entretiens,
        ]);
    }

            /**
     * @Route("/indexxR/{idpersonne}", name="app_entretien_indexxR", methods={"GET"})
     */
    public function indexxR(EntityManagerInterface $entityManager,$idpersonne,UserRepository $rep1): Response
    {
        
        $p=$rep1->find($idpersonne);

        $stages=$entityManager->getRepository(Stage::class)->ListStageByIdPersonne($p);
        $entretiens1=[];
        foreach ($stages as $s) {
            $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findByidstage($s->getIdstage());
            foreach ($entretiens as $e ) {
                array_push($entretiens1,$e);
            }
        } 

        

        return $this->render('entretien/index.html.twig', [
            'entretiens' => $entretiens1,
        ]);
    }


    /**
     * @Route("/new", name="app_entretien_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $repository): Response
    {
        $entretien = new Entretien();
        $personne = $repository->find(1);
        $entretien->setIduser($personne);
        $form = $this->createForm(Entretien1Type::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($entretien);
            $entityManager->flush();

            return $this->redirectToRoute('app_entretien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('entretien/new.html.twig', [
            'entretien' => $entretien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{identretien}", name="app_entretien_show", methods={"GET"})
     */
    public function show(EntretienRepository $rep1,$identretien): Response
    {
        $entretien=$rep1->find($identretien);
        return $this->render('entretien/show.html.twig', [
            'entretien' => $entretien,
        ]);
    }

        /**
     * @Route("/{identretien}/showetud", name="app_entretien_show_etudiant", methods={"GET"})
     */
    public function showetud(EntretienRepository $rep1,$identretien): Response
    {
        $entretien=$rep1->find($identretien);

        return $this->render('entretien/showetudiant.html.twig', [
            'entretien' => $entretien,
        ]);
    }

    /**
     * @Route("/{identretien}/edit", name="app_entretien_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request,EntretienRepository $rep1,$identretien, EntityManagerInterface $entityManager): Response
    {

        $entretien=$rep1->find($identretien);

        $form = $this->createForm(Entretien1Type::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entretien_indexxR', ['idpersonne'=> "1"], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('entretien/editForm.html.twig', [
            'entretien' => $entretien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{identretien}", name="app_entretien_delete", methods={"POST"})
     */
    public function delete(Request $request,EntretienRepository $rep1,$identretien, EntityManagerInterface $entityManager): Response
    {
        $entretien=$rep1->find($identretien);

        if ($this->isCsrfTokenValid('delete'.$entretien->getIdentretien(), $request->request->get('_token'))) {
            $entityManager->remove($entretien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entretien_indexxR', ['idpersonne'=> "1"], Response::HTTP_SEE_OTHER);
    }
   
}
