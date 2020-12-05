<?php

namespace App\Facade;

class Node
{
    /**
     * @var
     */
    public $value;

    /**
     * @var null
     */
    public $left = null;

    /**
     * @var null
     */
    public $right = null;

    /**
     * Node constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Node $node
     * @param Node|null $parent
     * @param string $left_right
     * @return bool
     */
    public function delete(Node $node, Node $parent = null, $left_right = '')
    {
        if ($node->value > $this->value) {
            return $this->right && $this->right->delete($node, $this, 'right');
        } elseif ($node->value < $this->value) {
            return $this->left && $this->left->delete($node, $this, 'left');
        } else {
            if ($this->left) {
                $parent->{$left_right} = $this->left;
                $this->right && $this->left->add($this->right);
            } elseif ($this->right) {
                $parent->{$left_right} = $this->right;
                $this->left && $this->right->add($this->left);
            } else {
                $parent->{$left_right} = null;
            }
            return true;
        }
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function detect(Node $node)
    {
        if ($node->value > $this->value) {
            return $this->right && $this->right->detect($node);
        } elseif ($node->value < $this->value) {
            return $this->left && $this->left->detect($node);
        } else {
            return true;
        }
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function add(Node $node)
    {
        if ($node->value > $this->value) {
            $this->right ? $this->right->add($node) : ($this->right = $node);
        } elseif ($node->value < $this->value) {
            $this->left ? $this->left->add($node) : ($this->left = $node);
        } else {
            return false;
        }
    }

    /**
     * @param array $array
     * @param Node|null $root
     * @return bool|\Generator
     */
    public function sort(array $array, Node $root = null)
    {
        if (!$array) {
            $array = $root;
        }
        if (!$array) {
            return false;
        }
        if ($array['left']) {
            yield from $this->sort($array['left']);
        }
        yield $array;
        if ($array['right']) {
            yield from $this->sort($array['right']);
        }
    }
}