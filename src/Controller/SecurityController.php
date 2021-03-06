<?php

namespace App\Controller;

use App\Entity\Faculte;
use App\Entity\ResetPassword;
use App\Entity\Societe;
use App\Entity\User;
use App\Form\ChoixRoleType;
use App\Form\UserType;
use App\Repository\FaculteRepository;
use App\Repository\ResetPasswordRepository;
use App\Repository\SocieteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(MailerInterface $mailer,EntityManagerInterface $em,Request $request): Response
    {

        $user = new User();
        $userForm = $this->createForm(UserType::class,$user);



        $userForm->handleRequest($request);
        if($userForm->isSubmitted() && $userForm->isValid()){

           $file = $userForm->get('pdp')->getData();
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

            $user->setPassword($user->getPassword());
            $user->setPdp($fileName);
            $user->setEtatBlock(0);
            if($user->getRole() == "Etudiant"){
                $user->setRoles(['ROLE_ETUDIANT']);
            }else if($user->getRole() == "Formateur"){
                $user->setRoles(['ROLE_FORMATEUR']);
            }else{
                $user->setRoles(['ROLE_RECRUTEUR']);
            }
            $em->persist($user);
            $em->flush();
            $email = new TemplatedEmail();
            // to , form , text,  attachment, bcc , cc,subject
            $email->from('MonStage <msalmi.skander@esprit.fr>')
                  ->to($user->getEmail())
                  ->subject('Bienvenue Sur Mon Stage')

                  ->htmlTemplate('@email_templates/welcome.html.twig')

                  ->context([
                        'username'=>$user->getUsername()
                    ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/inscription.html.twig', [
            'form' => $userForm->createView(),
        ]);


    }

    /**
     * @Route("/choixRole",name="choixRole")
     */
    public function choixRole(Request $request){
        $roleForm = $this->createForm(ChoixRoleType::class);
        $roleForm->handleRequest($request);
        if($roleForm->isSubmitted() && $roleForm->isValid()){

            return $this->redirectToRoute('inscription',array(
                'role'=>$request->get('choix_role')['role']
            ));
        }
            return $this->render('security/choixRole.html.twig',[
                'form'=>$roleForm->createView()
            ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/reset-password/{token}", name ="reset-password")
     */

    public function resetPassword(FlashyNotifier $flashyNotifier,UserPasswordEncoderInterface $passwordEncoder,Request $request,EntityManagerInterface $em,String $token,ResetPasswordRepository  $resetPasswordRepository){

        $resetPasswod = $resetPasswordRepository->findOneBy(['token'=>$token]);
        if(!$resetPasswod || $resetPasswod->getExpiredAt()< new \DateTime('now')){
            if($resetPasswod){
                $em->remove($resetPasswod);
                $em->flush();
            }
            $flashyNotifier->error('error',' Votre demande est expir?? veuillez refaire une demande');
            return $this->redirectToRoute('login');
        }
        $passwordForm = $this->createFormBuilder()
            ->add('password',PasswordType::class,[
                "label"=>"Entrer nouveau mot de passe"

            ])->getForm();

        $passwordForm->handleRequest($request);
        if($passwordForm->isSubmitted() && $passwordForm->isValid()){
            $password = $passwordForm->get('password')->getData();
            $user = $resetPasswod->getUser();
            $user->setPassword($password);
            $em->remove($resetPasswod);
            $em->flush();
            $flashyNotifier->success('success','votre mot de passe a ??t?? modifi??.');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/reset_password_form.html.twig',[
            'form'=>$passwordForm->createView()
        ]);
    }

    /**
     * @Route("/reset-password-request",name="reset-password-request")
     */


    public function resetPasswordRequest(FlashyNotifier $flashyNotifier,MailerInterface $mailer,Request $request,UserRepository $userRepository,ResetPasswordRepository $resetPasswordRepository,EntityManagerInterface $em){
        $emailForm = $this->createFormBuilder()->add('email',EmailType::class,[
            'required'   => false,
           'constraints'=> [
               new NotBlank([
                   'message'=>'Veuillez entrer votre email'
               ])
           ]
        ])->getForm();

        $emailForm->handleRequest($request);


        if($emailForm->isSubmitted() && $emailForm->isValid() ){
            if($userRepository->findBy(['email'=>$emailForm->get('email')->getData()])){
                $emailValue = $emailForm->get('email')->getData();
                $user = $userRepository->findOneBy(['email' => $emailValue]);
                if ($user) {
                    $oldResetPassword = $resetPasswordRepository->findOneBy(['User' => $user]);
                    if ($oldResetPassword) {
                        $em->remove($oldResetPassword);
                        $em->flush();
                    }
                    $resetPassword = new ResetPassword();
                    $resetPassword->setUser($user);
                    $resetPassword->setExpiredAt(new \DateTimeImmutable('+2 hours'));
                    $token = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(30))), 0, 20);
                    $resetPassword->setToken($token);
                    $em->persist($resetPassword);
                    $em->flush();
                    $email = new TemplatedEmail();
                    $email->from('msalmi.skander@esprit.tn')->to($emailValue)
                        ->subject('Demande de r??initialisation de mot de passe')
                        ->htmlTemplate('@email_templates/reset_password_request.html.twig')
                        ->context([
                            'token' => $token,
                            'username'=>$user->getUsername()
                        ]);
                    $mailer->send($email);
                }
                $flashyNotifier->success('un email a etait envoye a votre email');
            }else{
                $flashyNotifier->error("Adresse Mail n'existe pas ");

            }
            }


        return $this->render('security/reset_password_request.html.twig',[
            'form'=>$emailForm->createView()
        ]);
    }

    /**
     * @param $idUser
     * @param UserRepository $userRepository
     * @Route("/block/{idUser}",name="blockUser")
     * @return void
     */

    public function block_deblock_User($idUser,UserRepository $userRepository,EntityManagerInterface $em,FlashyNotifier $flashyNotifier){
        $user = $userRepository->find($idUser);
        $user->setEtatBlock(!$user->getEtatBlock());
        $mes = "vous avez debloque ".$user->getNom();

        $em->flush();
            return $this->redirectToRoute('app_admin_users');



    }


}







