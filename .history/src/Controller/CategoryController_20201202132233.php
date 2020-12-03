<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Entity\Category;
use App\Repository\CategoryRepository;

/**
 * @Route("/categories", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * Show all rows from Category's entity
     * 
     * @Route("/", name="index")
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', ['categories' => $categories
        ]);
    }

    /**
     * Getting a category by category name
     * 
     * @Route("/{categoryName}", name="show")
     * @return Response
     */
    public function show(string $categoryName): Response
    {
       $categoryName = new Category('name');

       if (!$categoryName) {
        throw $this->createNotFoundException(
                $categoryName . 'is not found.'
        );
        
        $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy($categoryName, ['id'=>'DESC'], 3);

        return $this->render('category/show.html.twig', ['categoryName' => $categoryName]
        );
    }
}
