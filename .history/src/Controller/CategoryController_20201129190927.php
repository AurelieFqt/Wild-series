<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use src\Entity\Program;

/**
 * @Route("/categories", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * Show all rows from Category's entity
     * 
     * @Route("/categories", name="category_index")
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        return $this->render('category/index.html.twig', ['categories' => $categories
        ]);
    }

    /**
     * Getting a category by category name
     * 
     * @Route("/categories/{categoryName}", name="category_show")
     * @return Response
     */
    public function show(string $categoryName): Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Program::class)

        if (!$program) {
            throw $this->createNotFoundException(
                    'No program with id: ' .$id. ' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', ['program' => $program]
        );
    }
}
