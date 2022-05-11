<?php

namespace App\Controller;

use App\Entity\Bibliotheque;
use App\Entity\Livre;
use App\Form\BibliothequeType;

use App\Repository\BibliothequeRepository;

use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class BibliothequeController extends AbstractController
{
    /**
     * @Route("/bibliotheque", name="app_bibliotheque")
     */
    public function index(PaginatorInterface $paginator,BibliothequeRepository $repository, Request $request): Response
    {
        $data = $repository->findAll();
        $biblio = $paginator-> paginate($data,
            $request->query->getInt('page',1),2);
        return $this->render('bibliotheque/index.html.twig',['bib'=> $biblio ]
        );
    }


    /**
     * @Route("/livreC/{id}", name="app_livreC")
     */
    public function livreC($id): Response
    {
        $livrecRepository = $this->getDoctrine()->getManager()->getRepository(Livre::class)->findBy(['intc'=>$id]);
        return $this->render('livre/livreClient.html.twig',['lv'=> $livrecRepository]
        );
    }


    /**
     * @Route("/livreClientJason", name="livreClientJason")
     */
    public function livreClientJson(Request $request)
    {
        $id=$request->query->get("intc");
        $livrecRepository = $this->getDoctrine()->getManager()->getRepository(Livre::class)->findBy(['intc'=>$id]);
        $serilizable = new Serializer([new ObjectNormalizer()]);
        $formated =$serilizable->normalize($livrecRepository);

        return new JsonResponse($formated);
    }

    /**
     * @Route("/bibliothequeClient", name="app_bibliothequeClient")
     */
    public function biblioClient(): Response
    {
        $bibliothequeCRepository = $this->getDoctrine()->getManager()->getRepository(Bibliotheque::class)->findAll();

return $this->render('bibliotheque/biblioClient.html.twig', ['bibC' => $bibliothequeCRepository,]
);
    }



    /**
     * @Route("/displayBibJSON", name="displayBibJSON")
     */
    public function indexTemp(): Response
    {

        $bibliothequeRepository = $this->getDoctrine()->getManager()->getRepository(Bibliotheque::class)->findAll();
       $serilizable = new Serializer([new ObjectNormalizer()]);
       $formated =$serilizable->normalize($bibliothequeRepository);

       return new JsonResponse($formated);
    }

    /**
     * @Route("/addBibliotheque", name="addBibliotheque")
     */
    public function addBibliotheque(Request $req ,FlashyNotifier $flashy): Response
    {
        $bibliotheque = new Bibliotheque();
        $form = $this->createForm(BibliothequeType::class,$bibliotheque);
        $form->handleRequest($req);
        if ($form->isSubmitted()&& $form->isValid())
            {
              $em=$this->getDoctrine()->getManager();
              $em->persist($bibliotheque);
              $em->flush();
              $flashy->success('Bibliotheque ajoutée ');
              return $this->redirectToRoute('app_bibliotheque');
            }
            return $this->render('bibliotheque/createBiblio.html.twig',['form'=> $form->createView()]);

    }




    /**
     * @Route("/removeBibliotheque{id}", name="removeBibliotheque")
     */
    public function removeBibliotheque(Bibliotheque $bib,FlashyNotifier $flashy): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($bib);
        $em->flush();
        $flashy->success('Bibliotheque supprimée ');
        return $this->redirectToRoute('app_bibliotheque');

    }


    /**
     * @Route("/updateBibliotheque{id}", name="updateBibliotheque")
     */
    public function updateBibliotheque(Request $req,$id,FlashyNotifier $flashy): Response
    {
        $bibliotheque = $this->getDoctrine()->getRepository(Bibliotheque::class)->find($id);
        $form = $this->createForm(BibliothequeType::class, $bibliotheque);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bibliotheque);
            $em->flush();
            $flashy->success('Bibliotheque modifiée ');
            return $this->redirectToRoute('app_bibliotheque');
        }
        return $this->render('bibliotheque/updateBiblio.html.twig', ['form' => $form->createView()]);

    }}
