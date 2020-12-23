<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProgramType;


/**
 * @Route("/programs", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program's entity
     * 
     * @Route("/", name="index")
     * @return Response
     */
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', ['programs' => $programs
        ]);
    }

    /**
     * The controller for the program add form
     * 
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        //Create a new Program Object
        $program = new Program();
        //Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        //Get data from http request
        $form->handleRequest($request);
        //Was the form submitted ?
        if ($form->isSubmitted()) {
            //Deal with the submitted data
            //Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            //Persist Program Object
            $entityManager->persist($program);
            //flush the persisted object
            $entityManager->flush();
            //Finally redirect to program list
            return $this->redirectToRoute('program_index');
        }
        //Render the form
        return $this->render('program/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * Getting a progrma by id
     * 
     * @Route("/{id<\d+>}", methods={"GET"}, name="show")
     * @return Response
     */
    public function show(Program $program): Response
    {
        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findAll();

        return $this->render('program/show.html.twig', ['program' => $program, 'seasons' => $seasons]
        );
    }

    /**
    * Getting season
    * 
    * @Route("/{programId}/seasons/{seasonId}", methods={"GET"}, name="season_show")
    * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"programId": "id"}})
    * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"seasonId": "id"}})
    * @return Response
    */
    public function showSeason(Program $program, Season $season): Response
    {

            return $this->render('program/season_show.html.twig', [ 
                'program' => $program,
                'season' => $season,
            ]);
    }

    /**
     * Getting episode
     * 
     * @Route("/{programId}/seasons/{seasonId}/episodes/{episodeId}", methods={"GET"}, name="episode_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"programId": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"seasonId": "id"}})
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episodeId": "id"}})
     * @return Response
     */
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode
        ]);
    }
}
