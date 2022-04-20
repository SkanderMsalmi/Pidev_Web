<?php

namespace App\Controller;

use App\Form\EditUserType;
use App\Form\UserType;
use App\Repository\CompetanceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

    #[IsGranted('ROLE_USER')]
    /**
     * @Route("/profile", name="profile")
     */
    public function index(ExperienceRepository $experienceRepository,CompetanceRepository $competanceRepository): Response
    {
        $user = $this->getUser();
        $competances = $competanceRepository->findBy(['idUser'=>$user->getId()]);
        $experiences = $experienceRepository->findBy(['iduser'=>$user->getId()]);
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'competenes'=>$competances,
            'experiences'=>$experiences
        ]);
    }
    /**
     * @Route("/editprofile/{idUser}", name="edit_profile")
     */
    public function editProfile($idUser,UserRepository $userRepository,Request $request){
        $user = $userRepository->find($idUser);
        $userForm = $this->createForm(EditUserType::class,$user);
        $userForm->handleRequest($request);
        if($userForm->isSubmitted() && $userForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('profile/editProfile.html.twig',[
            'f'=>$userForm->createView()
        ]);
    }
}
