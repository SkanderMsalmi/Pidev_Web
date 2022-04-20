<?php

namespace App\Controller;

use App\Repository\CompetanceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FaculteRepository;
use App\Repository\SocieteRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/listUsers", name="app_admin_users")
     */
    public function listUsers(UserRepository $repository): Response
    {
        $users= $repository->findAll();
        return $this->render('admin/listUsers.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/listsocietes", name="app_admin_societes")
     */
    public function listSociete(SocieteRepository $repository): Response
    {
        $societes = $repository->findAll();
        return $this->render('admin/listSocietes.html.twig', [
            'societes' => $societes,
        ]);
    }

    /**
     * @Route("/listcompetances", name="app_admin_competances")
     */
    public function listCompetances(CompetanceRepository $repository): Response
    {
        $competances = $repository->findAll();
        return $this->render('admin/listCompetances.html.twig', [
            'competances' => $competances,
        ]);
    }
    /**
     * @Route("/listfacultes", name="app_admin_facultes")
     */
    public function listFacultes(FaculteRepository $faculteRepository): Response
    {
        $facultes = $faculteRepository->findAll();
        return $this->render('admin/listFacultes.html.twig', [
            'facultes' => $facultes,
        ]);
    }
    /**
     * @Route("/listexperiences", name="app_admin_experiences")
     */
    public function index(ExperienceRepository $experienceRepository): Response
    {
        $experiences = $experienceRepository->findAll();
        return $this->render('admin/listExperiences.html.twig', [
            'experiences' => $experiences,
        ]);
    }
}
