<?php

namespace App\Controller;

use App\Entity\Proposition;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\PropositionRepository;
use App\Repository\QuestionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QuestionController extends AbstractController
{
    /**
     * @Route("/listQuestions", name="afficherQuestions", methods={"GET"})
     */
    public function index(
        EntityManagerInterface $entityManager,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data = $entityManager
            ->getRepository(Question::class)
            ->findAll();
        $questions = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('question/index.html.twig', [
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/addQuestion", name="ajouterQuestion", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager, PropositionRepository $pr, QuestionRepository $qr): Response
    {
        $question = new Question();

        //prepare propositions fields
        $prop1 = new Proposition();
        $prop1->setProposition("");
        $question->getPropositions()->add($prop1);
        $prop2 = new Proposition();
        $prop2->setProposition("");
        $question->getPropositions()->add($prop2);
        $prop3 = new Proposition();
        $prop3->setProposition("");
        $question->getPropositions()->add($prop3);
        // end preparation
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($question);
            $entityManager->flush();
            $pr->addProposition($question, $qr);
            return $this->redirectToRoute('afficherQuestions', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('question/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("listQuestions/{idquestion}", name="afficherQuestion", methods={"GET"})
     */
    public function show(Question $question): Response
    {
        $pr = $this->getDoctrine()->getRepository(Proposition::class);
        $props = $pr->find($question->getIdquestion());
        return $this->render('question/show.html.twig', [
            'question' => $question,
            'props' => $props
        ]);
    }

    /**
     * @Route("editQuestion/{idquestion}", name="modifierQuestion", methods={"GET", "POST"})
     */
    public function edit(Request $request, Question $question, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('afficherQuestions', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("deleteQuestion/{idquestion}", name="supprimerQuestion", methods={"POST"})
     */
    public function delete(Request $request, Question $question, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getIdquestion(), $request->request->get('_token'))) {
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('afficherQuestions', [], Response::HTTP_SEE_OTHER);
    }
}
