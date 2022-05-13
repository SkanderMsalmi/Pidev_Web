<?php

namespace App\Controller;

use App\Form\EditUserType;
use App\Form\UserType;
use App\Repository\CompetanceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\UserRepository;


use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{


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

    /**
     * @Route("/editprofilepict/{idUser}", name="edit_photo_profil")
     */

    public function editPhotoProfil(EntityManagerInterface $em,$idUser,Request $request,UserRepository $repository,FlashyNotifier $flashyNotifier){
        $user = $repository->find($idUser);
        $photoForm = $this->createFormBuilder()
            ->add('pdp',FileType::class,['label'=>'Image De Profil'])->getForm();
        $photoForm->handleRequest($request);
        if($photoForm->isSubmitted() && $photoForm->isValid()){
            $file = $photoForm->get('pdp')->getData();
            if($file){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('profiles_directory'),
                        $fileName
                    );
                }catch(FileException $e){

                }
            }else{
                $fileName="download.png";
            }
            $user->setPdp($fileName);
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('security/changePhoto.html.twig',[
            'form'=>$photoForm->createView()
        ]);
    }


}
