<?php

namespace App\Controller;

use App\Entity\FileReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Homepage
 */
class HomeController extends AbstractController
{
    use FileReader;

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('app/home.html.twig', [
            'nodes' => is_array(FileReader::getFile()) ? FileReader::getFile() : null,
        ]);
    }
}
