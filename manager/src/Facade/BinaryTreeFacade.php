<?php

namespace App\Facade;

class BinaryTreeFacade
{
    /**
     * @var Node
     */
    private Node $_root;

    /**
     * BinaryTreeStrategy constructor.
     * @param int|null $value
     */
    public function __construct(?int $value)
    {
        $this->_root = new Node($value);
    }

    /**
     * @return null
     */
    public function getRoot()
    {
        return $this->hasNode() ? $this->_root->right : null;
    }

    /**
     * @param Node $node
     * @return $this
     */
    public function add(Node $node)
    {
        $this->_root->add($node);
        return $this;
    }

    /**
     * @param array $array
     * @return bool|\Generator
     */
    public function sort(array $array)
    {
        return $this->_root->sort($array, $this->_root);
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function detect(Node $node)
    {
        return $this->hasNode() ? $this->_root->detect($node) : false;
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function delete(Node $node)
    {
        return $this->hasNode() ? $this->_root->delete($node, $this->_root, 'right') : $this->_root->delete($node, $this->_root);
    }

    /**
     * @return bool
     */
    public function hasNode()
    {
        return (bool)$this->_root->right;
    }

    /**
     * @param array $array
     * @return $this
     */
    public function arrayToNode(array $array)
    {
        if ($array['value']) {
            $this->add(new Node($array['value']));
        }
        if ($array['left']) {
            $this->add(new Node($array['left']['value']));
            $this->arrayToNode($array['left']);
        }

        if ($array['right']) {
            $this->add(new Node($array['right']['value']));
            $this->arrayToNode($array['right']);
        }
        return $this;
    }
}