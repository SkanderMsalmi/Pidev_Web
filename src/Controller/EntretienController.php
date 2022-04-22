<?php

namespace App\Controller;

use App\Entity\Entretien;
use App\Form\Entretien1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PersonneRepository;

/**
 * @Route("/entretien")
 */
class EntretienController extends AbstractController
{
    /**
     * @Route("/", name="app_entretien_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findAll();

        return $this->render('entretien/index.html.twig', [
            'entretiens' => $entretiens,
        ]);
    }
       /**
     * @Route("/indexx/{idpersonne}", name="app_entretien_indexx", methods={"GET"})
     */
    public function indexx(EntityManagerInterface $entityManager): Response
    {
        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findByIdpersonne(105);

        return $this->render('entretien/indexetudiant.html.twig', [
            'entretiens' => $entretiens,
        ]);
    }

            /**
     * @Route("/indexxR/{idpersonne}", name="app_entretien_indexxR", methods={"GET"})
     */
    public function indexxR(EntityManagerInterface $entityManager): Response
    {
        $entretiens = $entityManager
            ->getRepository(Entretien::class)
            ->findByIdpersonne(107);

        return $this->render('entretien/index.html.twig', [
            'entretiens' => $entretiens,
        ]);
    }


    /**
     * @Route("/new", name="app_entretien_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, PersonneRepository $repository): Response
    {
        $entretien = new Entretien();
        $personne = $repository->find(107);
        $entretien->setIdpersonne($personne);
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
    public function show(Entretien $entretien): Response
    {
        return $this->render('entretien/show.html.twig', [
            'entretien' => $entretien,
        ]);
    }

        /**
     * @Route("/{identretien}/showetud", name="app_entretien_show_etudiant", methods={"GET"})
     */
    public function showetud(Entretien $entretien): Response
    {
        return $this->render('entretien/showetudiant.html.twig', [
            'entretien' => $entretien,
        ]);
    }

    /**
     * @Route("/{identretien}/edit", name="app_entretien_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Entretien $entretien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Entretien1Type::class, $entretien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_entretien_indexxR', ['idpersonne'=> "107"], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('entretien/editForm.html.twig', [
            'entretien' => $entretien,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{identretien}", name="app_entretien_delete", methods={"POST"})
     */
    public function delete(Request $request, Entretien $entretien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entretien->getIdentretien(), $request->request->get('_token'))) {
            $entityManager->remove($entretien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_entretien_indexxR', ['idpersonne'=> "107"], Response::HTTP_SEE_OTHER);
    }
   
}
