<?php
namespace App\Controller;
use App\Entity\Formation;
use App\Entity\PropertySearch;
use App\Entity\Reservation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use App\Repository\UserRepository;
use App\Repository\ReservationRepository;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;



class FormationController extends AbstractController
{
    /**
     * @Route("/admin/formation", name="app_formation", methods={"GET"})
     */

    public function index(FormationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $formation = $paginator->paginate(
            $formation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );

        return $this->render('formation/index.html.twig', [
            'f' => $formation,
        ]);
    }


    ## liste formation lel etudiant
    /**
     * @Route("/ListFormationEtudiant", name="ListFormationEtudiant", methods={"GET"})
     */

    public function ListFormationEtudiant(FormationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $formation = $paginator->paginate(
            $formation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );

        return $this->render('formation/ListFormationEtudiant.html.twig', [
            'f' => $formation,
        ]);
    }


    ## liste formation lel admin
    /**
     * @Route("/admin/ListFormationAdmin", name="ListFormationAdmin", methods={"GET"})
     */

    public function ListFormationAdmin(FormationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $formation = $paginator->paginate(
            $formation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );

        return $this->render('formation/ListFormationAdmin.html.twig', [
            'f' => $formation,
        ]);
    }


    ## liste formation lel formateur
    /**
     * @Route("/ListFormationFormateur", name="ListFormationFormateur", methods={"GET"})
     */

    public function ListFormationFormateur(FormationRepository $repository,\Symfony\Component\HttpFoundation\Request $request, PaginatorInterface $paginator): Response
    {
        $formation = $paginator->paginate(
            $formation = $repository->findAll(),
            $request->query->getInt('page', 1),3
        );

        return $this->render('formation/ListFormationFormateur.html.twig', [
            'f' => $formation,
        ]);
    }





##Ajout formation
    /**
     * @Route("/newformation", name="newformation")
     */
    public function newformation(Request $request): Response
    {
        #,FlashyNotifier $flashy
        $formation = new Formation();
        #$formation->setIduser($this->getUser());
        $form= $this->createForm(Formationtype::class,$formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($formation); // ajout
            $em->flush();
            #$flashy->success('Formation ajoutée');
            #lehne zedt notification
            $this->addFlash('success','Formation ajoutée avec sucées');
            return $this->redirectToRoute('app_formation');
        }
        return $this->render('formation/newformation.html.twig',['f'=>$form->createView()]);
    }
## Modifier formation
    /**
     * @Route("/edit/{idFormation}", name="editformation", methods={"GET", "POST"})
     */
    public function editformation ($idFormation, Request $request, FormationRepository $formationRepository):Response
    {
        $formation = $formationRepository->find($idFormation);
        $form = $this->createForm(FormationType::class, $formation);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            #lehne zedt notification
            $this->addFlash('success','Formation modifier avec sucées');
            return $this->redirectToRoute('app_formation');
            # kenet profile : app_reservation_index
        }
        return $this->render('formation/editformation.html.twig',['ff'=>$form->createView()]);
    }
## Supprimer formation
    /**
     * @Route("/deleteformation/{idFormation}", name="deleteformation")
     */
    public function deleteformation($idFormation,FormationRepository $repository)
    {
        $formation = $repository->find($idFormation);
        $em = $this ->getDoctrine()->getManager();
        $em->remove($formation);
        $em->fLush();
        #lehne zedt notification
        $this->addFlash('success','Formation supprimer avec sucées');
        return $this->redirectToRoute('app_formation');

    }

    /**
     * @Route("/formation/{idFormation}", name="app_formation_show", methods={"GET"})
     */
    public function show(EntityManagerInterface $entityManager, $idFormation): Response
    {
        $formation = $entityManager
            ->getRepository(Formation::class)
            ->find($idFormation);

        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }
####
    /**
     * @Route("formation/searchFormationtx ", name="searchFormationtx")
     */
    public function searchFormation(Request $request,NormalizerInterface $Normalizer)
    {
        $repository = $this->getDoctrine()->getRepository(Formation::class);
        $requestString=$request->get('searchValue');
        //dd($requestString);
        $formations = $repository->searchByNom($requestString);
        //dd($formations);
        $jsonContent = $Normalizer->normalize($formations, 'json',['groups'=>'post:read']);
        //dd($jsonContent);
        $retour = json_encode($jsonContent);
        return new Response($retour);
    }

    /**
     * @Route ("formation/filterByID" , name="formationByIdASC")
     */
    function filterById(FormationRepository $repository, Request $request)
    {
        $formation = $repository->FilterFormationByID();
        return $this->render('formation/index.html.twig', [
            'formation' => $formation,
        ]);
    }

    /**
     * @Route ("formation/filterByName" , name="formationByName")
     */
    function filterByName(FormationRepository $repository, Request $request)
    {
        $formation = $repository->FilterFormationByName();
        return $this->render('formation/index.html.twig', [
            'formation' => $formation,
        ]);
    }

    /**
     * @Route ("formation/filterByExpiredDate" , name="formationByExpiredDate")
     */
    function filterByExpiredDate(FormationRepository $repository, Request $request)
    {
        $formation = $repository->FilterFormationByExpiredDate();
        return $this->render('formation/index.html.twig', [
            'formation' => $formation,
        ]);
    }


######## PDF
    /**
     * @Route("/DownloadProduitsDataFormation", name="DownloadProduitsDataFormation")
     */
    public function DownloadProduitsDataFormation(FormationRepository $repository)
    {
        $produits=$repository->findAll();

        // On définit les options du PDF
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('formation/download.html.twig',
            ['produits'=>$produits ]);


        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        $fichier = 'Tableau des Produits.pdf';

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
    }











}
