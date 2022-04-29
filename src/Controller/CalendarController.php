<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function index(FormationRepository $formationRepository): Response
    {
        // la recuperation des données
        $events = $formationRepository->findByAvailableDate();
        $rdvs = [];
        foreach($events as $event){
            $rdvs[] = [
                'idformation' => $event->getIdformation(),
                'description'=>$event->getDescription(),
                'titre' => $event->getTitre(),
                'type' => $event->getType(),
                'domaine' => $event->getDomaine(),
                'start' => $event->getDatedebut()->format('Y-m-d'),
                'end' => $event->getDatefin()->format('Y-m-d'),
                'description' => 'formation',
                'backgroundColor' => 'blue',
                "borderColor" => 'black',
                "textColor" => 'white',
                "allDay" => 'null'
            ];
        }
        $data = json_encode($rdvs);

        //dd($data);

        return $this->render('calendar/index.html.twig', compact('data'));
    }
}
