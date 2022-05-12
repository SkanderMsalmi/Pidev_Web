<?php

namespace App\Controller;

use App\Entity\Proposition;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\PropositionRepository;
use App\Repository\QuestionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class QuestionController extends AbstractController
{
    /**
     * @Route("/admin/listQuestions", name="afficherQuestions", methods={"GET"})
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
     * @Route("/admin/addQuestion", name="ajouterQuestion", methods={"GET", "POST"})
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
            $this->addFlash("success","Ajout Question avec reussi !");
            $pr->addProposition($question, $qr);
            return $this->redirectToRoute('afficherQuestions', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('question/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/listQuestions/{idquestion}", name="afficherQuestion", methods={"GET"})
     */
    public function show($idquestion): Response
    {
        $pr = $this->getDoctrine()->getRepository(Proposition::class);
        $qr = $this->getDoctrine()->getRepository(Question::class);
        $question = $qr->find($idquestion);
        $props = $pr->findBy(["idquestion" => $idquestion]);
        return $this->render('question/show.html.twig', [
            'question' => $question,
            'props' => $props
        ]);
    }

    /**
     * @Route("/admin/editQuestion/{idquestion}", name="modifierQuestion", methods={"GET", "POST"})
     */
    public function edit(Request $request, $idquestion, EntityManagerInterface $entityManager): Response
    {
        $pr = $this->getDoctrine()->getRepository(Proposition::class);
        $qr = $this->getDoctrine()->getRepository(Question::class);
        $question=$qr->find($idquestion);
        $props = $pr->findBy(["idquestion" => $idquestion]);
        $question->setPropositions($props);
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($question);
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('afficherQuestions', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/deleteQuestion/{idquestion}", name="supprimerQuestion", methods={"POST"})
     */
    public function delete(Request $request, $idquestion, EntityManagerInterface $entityManager): Response
    {
        $qr = $this->getDoctrine()->getRepository(Question::class);
        $pr = $this->getDoctrine()->getRepository(Proposition::class);
        $question = $qr->find($idquestion);
        $props = $pr->findBy(["idquestion" => $idquestion]);
        foreach ($props as $p ) {
            $ques = $qr->find($p->getIdquestion());
            $p->setIdquestion($ques);
            $question->addProposition($p);
        }
       // dd($question);
        if ($this->isCsrfTokenValid('delete'.$question->getIdquestion(), $request->request->get('_token'))) {
            
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('afficherQuestions', [], Response::HTTP_SEE_OTHER);
    }
}
