<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Score;
use App\Entity\Quiz;
use App\Form\ScoreType;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/score")
 */
class ScoreController extends AbstractController
{
    /**
     * @Route("/", name="app_score_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $uri = $_SERVER['REQUEST_URI'];
        $reps = [];
        $score = 0;
        $idquiz = $this->getIdquiz($_GET["question1"]);
        $qr = $this->getDoctrine()->getRepository(Quiz::class);
        $quiz = $qr->find($idquiz);
        foreach ($_GET as $question) {
            $id = $this->getId($question);
            $rep = $this->getReponse($question);
            array_push($reps,$rep);
            if ($this->verifierReponse($rep,$id)){
                $score++;
            }
        }
        $scores = $entityManager
            ->getRepository(Score::class)
            ->findAll();

        $scoreFinal= new Score();
        $scoreFinal->setIdquiz($quiz);
        $scoreFinal->setScore($score);
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($scoreFinal);
        $manager->flush();

        return $this->render('score/index.html.twig', [
            'scores' => $scores,
            'score' => $score,
            'reponses' => $reps,
        
        ]);
    }

    private function getIdquiz($str)
    {
        $x = strpos($str,"*")+1;
        return substr($str,$x);
    }
    private function getId($str)
    {
        $x = strpos($str,"~")+1;
        $y = strpos($str,"*")+1;
        return substr($str,$x,$y-$x);
    }

    private function getReponse($str)
    {
        $x = strpos($str,"~");
        return substr($str,0,$x);
    }

    private function verifierReponse($reponse, $id)
    {
        $qr = $this->getDoctrine()->getRepository(Question::class);
        $question = $qr->find($id);
        $repCor = $question->getReponsecorrecte();

        if ($repCor==$reponse) {
            return true;
        }
        return false;
    }

    /**
     * @Route("/new", name="app_score_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $score = new Score();
        $form = $this->createForm(ScoreType::class, $score);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($score);
            $entityManager->flush();

            return $this->redirectToRoute('app_score_index', [], Response::HTTP_SEE_OTHER);
        }
        

        return $this->render('score/new.html.twig', [
            'score' => $score,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idscore}", name="app_score_show", methods={"GET"})
     */
    public function show($idscore): Response
    {
        $sr = $this->getDoctrine()->getRepository(Score::class);
        $qr = $this->getDoctrine()->getRepository(Quiz::class);
        $score = $sr->findBy(["iduser" => NULL]);
       // dd($score);
        $idquiz = $score[0]->getIdquiz()->getIdquiz();
        $quiz = $qr->find($idquiz);
        $domaine = $quiz->getDomaine();
        $date = $quiz->getDatecreation();
        return $this->render('score/show.html.twig', [
            'score' => $score,
            'domaine' => $domaine,
            'date' => $date,
        ]);
    }

    /**
     * @Route("/{idscore}/edit", name="app_score_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Score $score, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ScoreType::class, $score);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_score_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('score/edit.html.twig', [
            'score' => $score,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idscore}", name="app_score_delete", methods={"POST"})
     */
    public function delete(Request $request, Score $score, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$score->getIdscore(), $request->request->get('_token'))) {
            $entityManager->remove($score);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_score_index', [], Response::HTTP_SEE_OTHER);
    }
}
