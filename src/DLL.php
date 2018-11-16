<?php
declare(strict_types=1);

/**
 * PHP data structure: Double Linked List = DLL
 *
 * DLL_Node can store: <int> $key, <any type> $value
 *
 * Array is auto sorted, on inserting new Node it is added so it keeps sorting...
 *
 * public methods:
 *
 * __construct ()
 * add (int $key, $value) : DLL // $value can be really ANY object
 * delete (int $key)
 * contains(int $key) : DLL_Node
 * count() : int
 * getMin() : int
 * getMax() : int
 * printList(DLL_Node $startNode=null)
 *
 */

namespace PHPDataStructures;

class DLL
{
    protected $count;
    protected $head;
    protected $tail;

    public function __construct()
    {
        $this->count = 0;
        $this->head = null;
        $this->tail = null;
    }

    public function add(int $key, $value) : DLL_node
    {
        if ($this->head == null and $this->tail != null) {
            throw new \Exception("Error in DLL, head is null, but tail is not null.");
        }
        if ($this->head != null and $this->tail == null) {
            throw new \Exception("Error in DLL, head is not null, but tail is null.");
        }

        $newNode = new DLL_node($key, $value);
        $this->count++;

        if ($this->head == null) {              // first ever node in DLL
            $this->head = $newNode;
            $this->tail = $newNode;
            return $newNode;
        }
        if ($key > $this->tail->getKey()) {     // greater then all elements in DLL
            $newNode->setPrev($this->tail);
            $this->tail->setNext($newNode);
            $this->tail = $newNode;
            return $newNode;
        }
        if ($key < $this->head->getKey()) {     // smaller then all elements in DLL
            $newNode->setNext($this->head);
            $this->head->setPrev($newNode);
            $this->head = $newNode;
            return $newNode;
        }
        $middleNode = $this->head;              // middle element
        while ($middleNode != $this->tail) {
            if ($key > $middleNode->getKey() and $key < $middleNode->getNext()->getKey()) {
                $newNode->setPrev($middleNode);
                $newNode->setNext($middleNode->getNext());
                $middleNode->getNext()->setPrev($newNode);
                $middleNode->setNext($newNode);
                return $newNode;
            }
            $middleNode = $middleNode->getNext();
        }
    }

    public function delete(int $key) : ?DLL_node
    {
        $oldNode = $this->contains($key);
        if ($oldNode) {
            $this->count--;
            if ($oldNode->getNext() == $oldNode->getPrev()) {   // only node in DLL
                $this->head = $this->tail = null;
                return $oldNode;
            }
            if ($this->head == $oldNode) {                      // first node in DLL
                $this->head = $oldNode->getNext();
                $oldNode->getNext()->setPrev(null);
            } else {
                $oldNode->getPrev()->setNext($oldNode->getNext());
            }
            if ($this->tail == $oldNode) {                      // last node in DLL
                $this->tail = $oldNode->getPrev();
                $oldNode->getPrev()->setNext(null);
            } else {
                $oldNode->getNext()->setPrev($oldNode->getPrev());
            }
            return $oldNode;
        }
        return null;
    }

    public function contains($key) : ?DLL_node
    {
        $node = $this->head;
        while ($node != null) {
            if ($node->getKey() == $key) {
                return $node;
            }
            $node = $node->getNext();
        }
        return null;
    }

    public function count() : int
    {
        return $this->count;
    }

    public function getMin() : int
    {
        $node = $this->head;
        $min = $this->head->getKey();
        while ($node != null) {
            if ($node->getKey() < $min) {
                $min = $node->getKey();
            }
                $node = $node->getNext();
        }
        return $min;
    }

    public function getMax() : int
    {
        $node = $this->head;
        $max = $this->head->getKey();
        while ($node != null) {
            if ($node->getKey() > $max) {
                $max = $node->getKey();
            }
                $node = $node->getNext();
        }
        return $max;
    }

    // Sequent print, just for testing purposes
    public function printList(DLL_node $startNode = null)
    {
        $node = !is_null($startNode)?$startNode:$this->head;
        echo "\n";
        while ($node != null) {
            echo $node->toString();
            $node = $node->getNext();
        }
        echo "Head = " . $this->head->getValue() . "\n";
        echo "Tail = " . $this->tail->getValue() . "\n";
    }
}
