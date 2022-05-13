<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\CompetanceRepository;
use App\Repository\ExperienceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="app_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_user_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}/edit", name="app_user_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/profile/{id}", name="user_profile")
     */
    public function userProfile(CompetanceRepository $competanceRepository,ExperienceRepository $experienceRepository,UserRepository $userRepository,$id):Response{
        $user = $userRepository->find($id);
        $current = $this->getUser();
        $competances = $competanceRepository->findBy(['idUser'=>$user->getId()]);
        $experiences = $experienceRepository->findBy(['iduser'=>$user->getId()]);
        if($current == $user){
            return $this->redirectToRoute('profile');
        }


        return $this->render('profile/user.html.twig', [
            'user' => $user,
            'competenes'=>$competances,
            'experiences'=>$experiences
        ]);
    }

    /**
     * @Route("/uploadcv",name="upload_cv")
     */

    public function uploadCv(EntityManagerInterface $em,Request $request,UserRepository $repository,FlashyNotifier $flashyNotifier){
        $fileName = null;
        $user =$repository->find($this->getUser()->getId()) ;
        $cvForm = $this->createFormBuilder()
            ->add('cv',FileType::class,['label'=>'CV'])->getForm();
        $cvForm->handleRequest($request);
        if($cvForm->isSubmitted() && $cvForm->isValid()){
            $file = $cvForm->get('cv')->getData();
            if($file){
                $fileName = md5(uniqid()).'.pdf';
                try{
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $fileName
                    );
                }catch(FileException $e){

                }
            }
            if($fileName){
                $user->setCv($fileName);

            }
            $em->flush();
            return $this->redirectToRoute('profile');
        }
        return $this->render('security/uploadCV.html.twig',[
            'form'=>$cvForm->createView()
        ]);
    }

   /* public function searchUsers(Request $request,UserRepository $repository){
        $requestString = $request->get('q');
        $users = $repository->findUsersByString($requestString);
        if(!$users){
            $result['users']['error']="User n'existe pas";
        }else{
            $result['users']=$$this->getRealUsers($users);
        }
        return new Response(json_encode($result));
    }

    public function getRealUsers($users){
        foreach ($users as $user){
            $realUsers[$users->getId()]= [$users->]
        }
    }*/

}
