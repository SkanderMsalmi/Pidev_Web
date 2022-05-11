<?php

namespace App\Controller;

use App\Entity\Proposition;
use App\Form\PropositionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proposition")
 */
class PropositionController extends AbstractController
{
    /**
     * @Route("/", name="app_proposition_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $propositions = $entityManager
            ->getRepository(Proposition::class)
            ->findAll();

        return $this->render('proposition/index.html.twig', [
            'propositions' => $propositions,
        ]);
    }

    /**
     * @Route("/new", name="app_proposition_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $proposition = new Proposition();
        $form = $this->createForm(PropositionType::class, $proposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($proposition);
            $entityManager->flush();

            return $this->redirectToRoute('app_proposition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('proposition/new.html.twig', [
            'proposition' => $proposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idproposition}", name="app_proposition_show", methods={"GET"})
     */
    public function show(Proposition $proposition): Response
    {
        return $this->render('proposition/show.html.twig', [
            'proposition' => $proposition,
        ]);
    }

    /**
     * @Route("/{idproposition}/edit", name="app_proposition_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Proposition $proposition, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PropositionType::class, $proposition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_proposition_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('proposition/edit.html.twig', [
            'proposition' => $proposition,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idproposition}", name="app_proposition_delete", methods={"POST"})
     */
    public function delete(Request $request, Proposition $proposition, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proposition->getIdproposition(), $request->request->get('_token'))) {
            $entityManager->remove($proposition);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_proposition_index', [], Response::HTTP_SEE_OTHER);
    }
}
