<?php
declare(strict_types=1);
namespace PHPDataStructures;

/**
 * Class AVL
 *
 * public methods:
 *
 * _constructor(int $key, $value)
 * insert()
 * delete()
 * contains() : bool

 * getKey(int $key)
 * getValue()
 * getParent() : AVL_node
 * setParent(AVL_node $node)
 * getLeft() : AVL_node
 * setLeft(AVL_node $node)
 * getRight()  : AVL_node
 * setRight(AVL_node $node)
 *
 *
 * isLeafNode() : bool
 * toString() : string
 */

class AVL_node
{

    private $key = null;      // Integer
    private $value = null;    // Generic, any type of data, preferably Object...

    private $left;    // type of AVL_Node
    private $right;   // type of AVL_Node
    private $parent;  // type of AVL_Node

    public function __construct(int $key, $value, AVL_node $parent = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->parent = ($parent)?$parent:null;
    }

    /**
     * @param int $key
     */
    public function setKey(int $key)
    {
        $this->key = $key;
    }

    /**
     * @return int|null
     */
    public function getKey(): int
    {
        return $this->key;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param null $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getLeft() : ?AVL_node
    {
        return $this->left;
    }

    /**
     * @param mixed $left
     */
    public function setLeft(AVL_node $left = null)
    {
        $this->left = $left;
    }

    /**
     * @return mixed
     */
    public function getRight() : ?AVL_node
    {
        return $this->right;
    }

    /**
     * @param mixed $right
     */
    public function setRight(AVL_node $right = null)
    {
        $this->right = $right;
    }

    /**
     * @return null|AVL_node
     */
    public function getParent() : ?AVL_node
    {
        return $this->parent;
    }

    /**
     * @param null|AVL_node $parent
     */
    public function setParent(AVL_node $parent = null)
    {
        $this->parent = $parent;
    }

    public function isLeafNode()
    {
        if ($this->left==null and $this->right==null) {
            return true;
        }
        return false;
    }

    public function toString() : string
    {
        return "Key: $this->key; Value: $this->value; " .
            "Parent: " . ($this->parent?$this->parent->key:"-") . "; " .
            "Left: " . ($this->left?$this->left->key:"") . "; " .
            "Right: " . ($this->right?$this->right->key:"");
    }
}
