<?php

namespace App\Controller;

use App\Entity\Proposition;
use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\QuizType;
use App\Repository\QuizRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



/**
 * @Route("/quiz")
 */
class QuizController extends AbstractController
{
    /**
     * @Route("/", name="app_quiz_index", methods={"GET"})
     */
    public function index(
        EntityManagerInterface $entityManager,
        PaginatorInterface $paginator,
        Request $request): Response
    {
        $data = $entityManager
            ->getRepository(Quiz::class)
            ->findAll();
            $quizzes = $paginator->paginate(
                $data,
                $request->query->getInt('page', 1),
                10
            );
            

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizzes,
        ]);
    }

    /**
     * @Route("/new", name="app_quiz_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quiz = new Quiz();
        $time = new \DateTime();
        $quiz->setDatecreation($time);
        
        $form = $this->createForm(QuizType::class, $quiz);
        /*$domaines = $this->getDoctrine()->getRepository(Quiz::class)->getDomaines();
        $domaineArray = [];
        $domaineArray = array_flip($domaineArray);
        foreach ($domaines as $value) {
            array_push($domaineArray,$value["domaine"]);
        }
       // dd($domaineArray);
        $form->add('domaine', ChoiceType::class, [
            'choices'  => [$domaineArray],
        ]);*/
        $form->handleRequest($request);
        $quiz->setDomaine($form["domaine"]->getData());
        
       // dd($form["domaine"]->getData());

        //dd($request);

        if ($form->isSubmitted()) {
            //$domaine = $request->request->get("domaine");
            $domaine = $form["domaine"]->getData();
           // dd($domaine);
            $questions = $entityManager->getRepository(Question::class)->findBy(array(
                "domaine" => $quiz->getDomaine(),
            ));
            $randomKeys = array_rand($questions,5);
            $idQ1 = $questions[$randomKeys[0]]->getIdquestion();
            $question1 = $this->getDoctrine()->getRepository(Question::class)->find($idQ1);
            $idQ2 = $questions[$randomKeys[1]]->getIdquestion();
            $question2 = $this->getDoctrine()->getRepository(Question::class)->find($idQ2);
            $idQ3 = $questions[$randomKeys[2]]->getIdquestion();
            $question3 = $this->getDoctrine()->getRepository(Question::class)->find($idQ3);
            $idQ4 = $questions[$randomKeys[3]]->getIdquestion();
            $question4 = $this->getDoctrine()->getRepository(Question::class)->find($idQ4);
            $idQ5 = $questions[$randomKeys[4]]->getIdquestion();
            $question5 = $this->getDoctrine()->getRepository(Question::class)->find($idQ5);
            $quiz->setIdquestion1($question1);
            $quiz->setIdquestion2($question2);
            $quiz->setIdquestion3($question3);
            $quiz->setIdquestion4($question4);
            $quiz->setIdquestion5($question5);
            
            $entityManager->persist($quiz);
            $entityManager->flush();
            $this->addFlash("success","Le quiz est bien crée");

            return $this->redirectToRoute('app_quiz_passer', []);
        }

        return $this->render('quiz/new.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/passerQuiz", name="app_quiz_passer")
     */
    public function passerQuiz(): Response
    {
        
        $quiz = new Quiz();
        $quiz=$this->getDoctrine()->getRepository(Quiz::class)->findLastQuiz();
        $idQ1 = $quiz->getIdquestion1()->getidQuestion();
        $question1=$this->getQuestions($idQ1);
        $idQ2 = $quiz->getIdquestion2()->getidQuestion();
        $question2=$this->getQuestions($idQ2);
        $idQ3 = $quiz->getIdquestion3()->getidQuestion();
        $question3=$this->getQuestions($idQ3);
        $idQ4 = $quiz->getIdquestion4()->getidQuestion();
        $question4=$this->getQuestions($idQ4);
        $idQ5 = $quiz->getIdquestion5()->getidQuestion();
        $question5=$this->getQuestions($idQ5);
        $score =0;
        //dd($quiz);
        return $this->render('quiz/passerQuiz.html.twig', [
            "quiz" =>$quiz,
            "score" => $score,
        ]);
    }

    private function getQuestions($idQ)
    {
        $question = new Question();
        $question = $this->getDoctrine()->getRepository(Question::class)->find($idQ);
        $propositions = $this->getDoctrine()->getRepository(Proposition::class)->findBy(["idquestion" => $idQ]);
        $question->setIdquestion($idQ);
        $question->setPropositions($propositions);

    }

    /**
     * @Route("/{idquiz}", name="app_quiz_show", methods={"GET"})
     */
    public function show(Quiz $quiz): Response
    {
        return $this->render('quiz/show.html.twig', [
            'quiz' => $quiz,
        ]);
    }

    /**
     * @Route("/{idquiz}/edit", name="app_quiz_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Quiz $quiz, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuizType::class, $quiz);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('quiz/edit.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idquiz}", name="app_quiz_delete", methods={"POST"})
     */
    public function delete(Request $request, Quiz $quiz, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quiz->getIdquiz(), $request->request->get('_token'))) {
            $entityManager->remove($quiz);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quiz_index', [], Response::HTTP_SEE_OTHER);
    }


}
