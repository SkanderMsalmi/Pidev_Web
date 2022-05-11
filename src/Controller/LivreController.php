<?php

namespace App\Controller;

use App\Entity\Bibliotheque;
use App\Entity\Livre;
use App\Entity\Rate;
use App\Form\BibliothequeType;
use App\Form\LivreType;
use App\Form\RateType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\file;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\LivreRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="app_livre",methods={"GET","POST"})
     */
    public function index(PaginatorInterface $paginator, LivreRepository $repository, Request $request): Response
    {
        $livre = new Livre();
        $form = $this->createFormBuilder($livre)->add('titrel',TextType::class,array('attr'=>array('class'=>'form-control')))->add('ajouter', SubmitType::class)-> getForm();
        $rq = $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $term = $livre->getTitrel() ;

            $allLivres = $repository->search($rq->get('titrel')->getData());

        }else
        {
            $allLivres = $repository->findAll();

        }


        $liv = $paginator->paginate($allLivres ,
            $request->query->getInt('page', 1), 5);
        return $this->render('livre/index.html.twig', ['Liv' => $liv,'form'=>$form->createView()]
        );
    }

    /**
     * @Route("/telecharger/{id}", name="telecharger")
     */
    public function download($id, FlashyNotifier $flashy, Request $request): Response
    {
        $livrecRepository = $this->getDoctrine()->getManager()->getRepository(Livre::class)->find($id);


        return $this->render('rate/download.html.twig', ['ddd' => $livrecRepository]);
      //  return $this->redirectToRoute('infoLivre', ['id' => $id]);

    }


    /**
     * @Route("/infoLivre/{id}", name="infoLivre")
     */
    public function infoLivre($id, FlashyNotifier $flashy, Request $request): Response
    {
        $livrecRepository = $this->getDoctrine()->getManager()->getRepository(Livre::class)->find($id);
        $livrecRepository->setRateTotal($this->moyenne($id));
        $rate = new Rate();
        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rate);
            $em->flush();
            $flashy->success('merci pour voter ');
            return $this->redirectToRoute('infoLivre');
        }
        return $this->render('rate/livre.html.twig', ['infoL' => $livrecRepository, 'rt' => $form->createView()]
        );
    }


    /**
     * @Route("/addLivre", name="addLivre")
     */
    public function addLivre(Request $req, FlashyNotifier $flashy): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $file2 = $form->get('pdfivre')->getData();

            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $filename2 = md5(uniqid()) . '.' . $file2->guessExtension();

            $em = $this->getDoctrine()->getManager();
            $livre->setImage($filename);
            $livre->setPdfivre($filename2);
            $em->persist($livre);
            $em->flush();

            $file2->move(
                $this->getParameter('uploads_directory'),
                $filename2
            );

            $file->move(
                $this->getParameter('uploads_directory'),
                $filename
            );


            $flashy->success('livre ajoutée ');

            return $this->redirectToRoute('app_livre');
        }
        return $this->render('livre/createLivre.html.twig', ['form' => $form->createView()]);

    }

    /**
     * @Route("/removeLivre{id}", name="removeLivre")
     */
    public function removeBibliotheque(Livre $liv, FlashyNotifier $flashy): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($liv);
        $em->flush();
        $flashy->success('livre supprimé ');
        return $this->redirectToRoute('app_livre');

    }

    /**
     * @Route("/updateLivre{id}", name="updateLivre")
     */
    public function updateBibliotheque(Request $req, $id, FlashyNotifier $flashy): Response
    {
        $livre = $this->getDoctrine()->getRepository(Livre::class)->find($id);
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($livre);
            $em->flush();
            $flashy->success('livre modifié ');
            return $this->redirectToRoute('app_livre');
        }
        return $this->render('livre/updateLivre.html.twig', ['form' => $form->createView()]);

    }

    public function moyenne($id)

    {

        $rates = $this->getDoctrine()->getRepository(Rate::class)->findByIdLivre($id);
        $total = 0;
        for ($i = 0; $i < count($rates); $i++) {
            $total = $total + $rates[$i]->getRate();

            $moyenne = $total / count($rates);
        }
        return $moyenne;


    }



}