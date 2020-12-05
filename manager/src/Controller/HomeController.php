<?php

namespace App\Controller;

use App\Repository\Contracts\FileReaderRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Homepage
 */
class HomeController extends AbstractController
{
    /**
     * @var FileReaderRepositoryInterface
     */
    private $fileReaderRepository;

    /**
     * HomeController constructor.
     * @param FileReaderRepositoryInterface $fileReaderRepository
     */
    public function __construct(FileReaderRepositoryInterface $fileReaderRepository)
    {
        $this->fileReaderRepository = $fileReaderRepository;
    }
    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('app/home.html.twig', [
            'nodes' => is_array($this->fileReaderRepository->getFile()) ? $this->fileReaderRepository->getFile() : null,
        ]);
    }
}
