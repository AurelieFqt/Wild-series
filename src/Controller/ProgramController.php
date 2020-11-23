<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    /**
     * @Route("/programs/", name="program_index")
     */
    public function index(): Response
    {
        return $this->render('program/index.html.twig', ['website' => 'Wild Series',
        ]);
    }

    /**
     * @Route("/programs/", name="program_list")
     */
    public function list(): Response
    {
        return $this->render('program/list.html.twig', ['website' => 'Wild Series',
        ]);
    }
}