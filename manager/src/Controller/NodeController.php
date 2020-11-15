<?php

namespace App\Controller;

use App\Entity\FileReader;
use App\Entity\Node;
use App\Repository\BinarySearchTreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/node")
 */
class NodeController extends AbstractController
{
    use FileReader;

    /**
     * @Route("/", name="node_index", methods={"GET"})
     */
    public function index(): Response
    {
        $jsonDecodeTree = FileReader::getFile();
        if (is_array($jsonDecodeTree)) {
            $tree = new BinarySearchTreeRepository($jsonDecodeTree['value']);
            $sortedTree = $tree->sort($jsonDecodeTree);
        }

        return $this->render('node/index.html.twig', [
            'nodes' => $sortedTree ?? null,
        ]);
    }

    /**
     * @Route("/new", name="node_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $node = new Node(null);
        $nodeValue = !empty ($request->request->get('value')) ? $request->request->get('value') : null;

        if (!empty($nodeValue)) {
            $jsonDecodeTree = !is_null(FileReader::getFile()) ? FileReader::getFile() : [];

            $tree = new BinarySearchTreeRepository($jsonDecodeTree['value'] ?? $nodeValue);
            if ($jsonDecodeTree) {
                $tree->add(new Node($nodeValue));
            } else {
                $objectToArray = (array) $tree;
                $jsonDecodeTree = (array) $objectToArray[array_key_first($objectToArray)];
            }
            $tree->arrayToNode($jsonDecodeTree);
            FileReader::setDataToFile($tree);

            return $this->redirectToRoute('node_index');
        }

        return $this->render('node/new.html.twig', [
            'node' => $node,
        ]);
    }

    /**
     * @Route("/{value}", name="node_delete", methods={"GET"})
     */
    public function delete(Request $request, int $value): Response
    {
        $jsonDecodeTree = FileReader::getFile();
        if ($jsonDecodeTree['value'] == $value) {
            $this->addFlash(
                'error', ['message' => "You can't delete root!"]
            );
        }
        $tree = new BinarySearchTreeRepository($jsonDecodeTree['value']);
        $tree->arrayToNode($jsonDecodeTree);
        $tree->delete(new Node(intval($value)));
        FileReader::setDataToFile($tree);

        return $this->redirectToRoute('node_index');
    }

    /**
     * @Route("/seeds/generate", name="node_seeds", methods={"GET"})
     */
    public function seeds(): Response
    {
        $tree = new BinarySearchTreeRepository(6);
        $tree->add(new Node(10));
        $tree->add(new Node(11));
        $tree->add(new Node(9));
        $tree->add(new Node(7));
        $tree->add(new Node(12));
        $tree->add(new Node(15));
        $tree->add(new Node(8));
        FileReader::setDataToFile($tree);

        return $this->redirectToRoute('node_index');
    }
}
