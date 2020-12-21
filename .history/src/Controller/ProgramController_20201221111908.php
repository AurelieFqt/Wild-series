<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;

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
     * Getting a program by id
     * 
     * @Route("/{id<\d+>}", methods={"GET"}, name="show")
     * @return Response
     */
    public function show(int $id): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                    'No program with id: ' .$id. ' found in program\'s table.'
            );
        }

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
    * @return Response
    */
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository): Response
    {
        $seasonInfos = $seasonRepository->findOneBy(['id' => $seasonId]);

            return $this->render('program/season_show.html.twig', [ 
                'programId' => $programId,
                'seasonId' => $seasonId,
                'season' => $seasonInfos
            ]);
    }
}
