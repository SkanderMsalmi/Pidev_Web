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


class RateController extends AbstractController
{





    /**
     * @Route("/rate/{id}", name="rate")
     */
    public function rate($id, FlashyNotifier $flashy, Request $request, LivreRepository $repository): Response
    {

       $rate = new Rate();
       $rate->setRate($_POST['rating']);
       $livre=$repository->find($id);
       $rate->setIdl($livre);
       $em =$this->getDoctrine()->getManager();
       $em->persist($rate);
       $em->flush();
        $flashy->success('merci pour voter ');
        return $this->redirectToRoute('infoLivre',['id'=>$id]);

    }









}