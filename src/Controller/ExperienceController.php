<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperienceController extends AbstractController
{
    /**
     * @Route("/experience", name="app_experience")
     */
    public function index(ExperienceRepository $experienceRepository): Response
    {
        $experiences = $experienceRepository->findAll();
        return $this->render('experience/index.html.twig', [
            'experiences' => $experiences,
        ]);
    }

    /**
     * @Route("/addexperience", name="add_experience")
     */
    public function addExperience(Request $request){
        $experience = new Experience();
        $experience->setIdUser($this->getUser());
        $expForm = $this->createForm(ExperienceType::class,$experience);
        $expForm->handleRequest($request);
        if($expForm->isSubmitted() && $expForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($experience);
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('experience/addExperience.html.twig',[
            'f'=>$expForm->createView()
        ]);
    }
    /**
     * @Route("/editexperience/{idExperience}", name="edit_experience")
     */
    public function editExperience($idExperience,Request $request,ExperienceRepository $experienceRepository){
        $experience = $experienceRepository->find($idExperience);
        $expForm = $this->createForm(ExperienceType::class,$experience);
        $expForm->handleRequest($request);
        if($expForm->isSubmitted() && $expForm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('experience/editExperience.html.twig',[
            'f'=>$expForm->createView()
        ]);
    }
    /**
     * @Route("/suppexperience/{idExperience}", name="supp_experience")
     */
    public function suppExperience($idExperience,ExperienceRepository $repository){
        $experience = $repository->find($idExperience);
        $em = $this->getDoctrine()->getManager();
        $em->remove($experience);
        $em->flush();
        return $this->redirectToRoute('profile');
    }
}
