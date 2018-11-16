<?php
declare(strict_types=1);
namespace PHPDataStructures;

/**
 * AVL tree, named after inventors Adelson-Velsky and Landis
 * Also known as: Balanced Binary Search Tree or BBST
 *
 * AVL_node can store: <int> $key, <any type> $value
 *
 * public methods:
 *
 * _construct()
 * insert(int $key, $value)
 * delete()
 * contains() : bool
 * search(int $key) : AVL_node
 * getValue()
 * count()
 * printTree()
 * getMin()
 * getMax()
 */

class AVL
{
    private $root=null;    // type of AVL_node
    private $count=0;

    public function __construct()
    {
        $this->count = 1;
        $this->root = null;
    }

    public function insert(int $key, $value, AVL_node $startNode = null)
    {
        if (is_null($this->root)) {
            $this->root = new AVL_node($key, $value);
        } else {
            $node = !is_null($startNode) ? $startNode : $this->root;
            if ($key == $node->getKey()) {
                return false;
            }
            if ($key < $node->getKey()) {
                if (is_null($node->getLeft())) {
                    $node->setLeft(new AVL_node($key, $value, $node));
                    $this->count++;
                } else {
                    $this->insert($key, $value, $node->getLeft());
                }
            } else {
                if (is_null($node->getRight())) {
                    $node->setRight(new AVL_node($key, $value, $node));
                    $this->count++;
                } else {
                    $this->insert($key, $value, $node->getRight());
                }
            }
        }
        return true;
    }

    public function delete(int $key): bool
    {
        $toDelete = $this->search($key);
        if (!$toDelete) {
            return false;
        }

        $parent = $toDelete->getParent();
        $left = $toDelete->getLeft();
        $right = $toDelete->getRight();

        if ($toDelete->isLeafNode()) {
            $this->deleteLeafNode($toDelete);
            unset($toDelete);
        } else {
            if (($left and (! $right)) or ((! $left) and $right)) {
                if (is_null($parent)) {
                    $this->deleteRootNodeWithOneChild($toDelete);
                    if ($left) {
                        unset($left);
                    } else {
                        unset($right);
                    }
                } else {
                    $this->deleteNodeWithOneChild($toDelete);
                    unset($toDelete);
                    if (!$this->isBalanced($parent)) {
                        $this->balanceNode($parent);
                    }
                }
            }
            if (!is_null($left) and !is_null($right)) {
                $predecessor = $this->getPredecessor($toDelete);
                $this->swapNodes($toDelete, $predecessor);
                $this->deleteLeafNode($predecessor);
                unset($predecessor);
            }
        }
        $this->count--;
        return true;
    }

    private function isBalanced(AVL_node $nodeToCheck = null): bool
    {
        $leftBalance = $rightBalance = true;
        $leftHeight = $rightHeight = 0;

        $node = (is_null($nodeToCheck))? $this : $nodeToCheck;

        if ($node->getLeft()) {
            $leftBalance = $this->isBalanced($node->getLeft());
            $leftHeight = $this->height($node->getLeft());
        }
        if ($node->getRight()) {
            $rightBalance = $this->isBalanced($node->getRight());
            $rightHeight = $this->height($node->getRight());
        }
        return ($leftBalance and $rightBalance and abs($leftHeight-$rightHeight)<=1);
    }

    private function deleteLeafNode(AVL_node &$toDelete) : bool
    {
        if (! $toDelete->isLeafNode()) {
            return false;
        }
        if ($toDelete->getParent()) {
            if ($toDelete->getParent()->getLeft() == $toDelete) {
                $toDelete->getParent()->setLeft(null);
            } else {
                $toDelete->getParent()->setRight(null);
            }
            unset ($toDelete);
        }
        return true;
    }

    private function swapNodes(AVL_node &$parent, AVL_node &$child)
    {
        $temp = new AVL_node(0, "Null");

        $temp->setKey($parent->getKey());
        $temp->setValue($parent->getValue());
        $parent->setKey($child->getKey());
        $parent->setValue($child->getValue());
        $child->setKey($temp->getKey());
        $child->setValue($temp->getValue());
    }

    private function deleteNodeWithOneChild(AVL_node &$toDelete) : bool
    {
        $parent = $toDelete->getParent();
        $left = $toDelete->getLeft();
        $right = $toDelete->getRight();

        if ($toDelete->getKey() < $parent->getKey()) {  // parent's left child
            if ($toDelete->getLeft()) {
                $left->setParent($parent);
                $parent->setLeft($left);
            } else {
                $right->setParent($parent);
                $parent->setLeft($right);
            }
        } else {                                // parent's right child
            if ($toDelete->getLeft()) {
                $left->setParent($parent);
                $parent->setRight($left);
            } else {
                $right->setParent($parent);
                $parent->setRight($right);
            }
        }
        return true;
    }

    public function getMax(AVL_node $startNode = null)
    {
        $node = !is_null($startNode)?$startNode:$this->root;

        if (is_null($node->getRight())) {
            return $node;
        }
        return $this->getMax($node->getRight());
    }

    public function getMin(AVL_node $startNode=null)
    {
        $node = !is_null($startNode)?$startNode:$this->root;

        if (is_null($node->getLeft())) {
            return $node;
        }
        return $this->getMin($node->getLeft());
    }

    private function getPredecessor(AVL_node $node)
    {
        return $this->getMax($node->getLeft());
    }

    private function height(AVL_node $node=null): int
    {
        $leftHeight = $rightHeight = null;
        if (is_null($node)) {
            return 0;
        }

        if (!is_null($node->getLeft())) {
            $leftHeight = $this->height($node->getLeft());
        }
        if (!is_null($node->getRight())) {
            $rightHeight = $this->height($node->getRight());
        }
        return 1 + max($leftHeight, $rightHeight);
    }

    public function contains(int $key, AVL_node $startNode=null) : bool
    {
        $node = !is_null($startNode)?$startNode:$this->root;

        if ($key == $node->getKey()) {
            return true;
        }

        if ($key < $node->getKey()) {
            if (is_null($node->getLeft())) {
                return false;
            } else {
                return $this->contains($key, $node->getLeft());
            }
        } else {
            if (is_null($node->getRight())) {
                return false;
            } else {
                return $this->contains($key, $node->getRight());
            }
        }
    }

    public function search(int $key, AVL_node $startNode=null) : ?AVL_node
    {
        $node = !is_null($startNode)?$startNode:$this->root;

        if ($key == $node->getKey()) {
            return $node;
        }

        if ($key < $node->getKey()) {
            if (is_null($node->getLeft())) {
                return null;
            } else {
                return $this->search($key, $node->getLeft());
            }
        } else {
            if (is_null($node->getRight())) {
                return null;
            } else {
                return $this->search($key, $node->getRight());
            }
        }
    }

    public function count()
    {
        return $this->count;
    }

    // InOrder Traversal, just for testing purposes
    public function printTree(AVL_node $startNode = null)
    {
        $node = !is_null($startNode)?$startNode:$this->root;
        echo "\r";
        if (!is_null($node->getLeft())) {
            $this->printTree($node->getLeft());
        }
        echo $node->toString() . "; Height: " . $this->height($node) . ";\n";
        if (!is_null($node->getRight())) {
            $this->printTree($node->getRight());
        }
    }
}
