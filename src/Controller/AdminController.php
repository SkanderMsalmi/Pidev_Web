<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\CompetanceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FaculteRepository;
use App\Repository\SocieteRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/listUsers", name="app_admin_users")
     */
    public function listUsers(PaginatorInterface $paginator,Request $request,UserRepository $repository): Response
    {
        $users = new User();
        $form = $this->createFormBuilder($users)
            ->add('nom',TextType::class,array('attr'=>array('class'=>'form-control'),'required'=>'false'))
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $term = $users->getNom();
            $allUsers = $repository->search($term);
        }else{
            $allUsers = $repository->findAll();
        }
        //$donnes = $repository->findAll();
        $users = $paginator->paginate(
            $allUsers,
            $request->query->getInt('page',1),
            10
        );
        return $this->render('admin/listUsers.html.twig', [
            'users' => $users,
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/listsocietes", name="app_admin_societes")
     */
    public function listSociete(Request $request,SocieteRepository $repository,PaginatorInterface $paginator): Response
    {

        $donnes = $repository->findAll();
        $societes = $paginator->paginate(
            $donnes,
            $request->query->getInt('page',1),
            10
        );
        return $this->render('admin/listSocietes.html.twig', [
            'societes' => $societes,

        ]);
    }

    /**
     * @Route("/listcompetances", name="app_admin_competances")
     */
    public function listCompetances(PaginatorInterface $paginator,Request $request,CompetanceRepository $repository): Response
    {
        $donnes = $repository->findAll();
        $competances = $paginator->paginate(
            $donnes,
            $request->query->getInt('page',1),
            10
        );
        return $this->render('admin/listCompetances.html.twig', [
            'competances' => $competances,
        ]);
    }
    /**
     * @Route("/listfacultes", name="app_admin_facultes")
     */
    public function listFacultes(PaginatorInterface $paginator,Request $request,FaculteRepository $faculteRepository): Response
    {
        $donnes = $faculteRepository->findAll();
        $facultes = $paginator->paginate(
            $donnes,
            $request->query->getInt('page',1),
            10
        );
        return $this->render('admin/listFacultes.html.twig', [
            'facultes' => $facultes,
        ]);
    }
    /**
     * @Route("/listexperiences", name="app_admin_experiences")
     */
    public function listExperiences(PaginatorInterface $paginator,Request $request,ExperienceRepository $experienceRepository): Response
    {
        $donnes = $experienceRepository->findAll();
        $experiences = $paginator->paginate(
            $donnes,
            $request->query->getInt('page',1),
            10
        );
        return $this->render('admin/listExperiences.html.twig', [
            'experiences' => $experiences,
        ]);
    }
}
