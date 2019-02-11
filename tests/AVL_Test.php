<?php
declare(strict_types=1);
namespace PHPDataStructures;

//require_once ('vendor/phpunit/phpunit/src/Framework/Assert/Functions.php');
//use PHPDataStructures\AVL;
use PHPUnit\Framework\TestCase;

class AVL_Test extends TestCase
{
    public function test_AVL_basics()
    {
        // create a tree
        $tree = new AVL();

        // add some objects/nodes in a tree
        $tree->insert(25, "Twenty five");
        $tree->insert(10, "Ten");
        $tree->insert(35, "Thirdy five");
        $tree->insert(15, "Fifteen");
        $tree->insert(20, "Twenty");
        $tree->insert(21, "Twenty one");
        $tree->insert(30, "Thirdy");

        // check if all were added
        assertEquals($tree->count(), 7);

        // check if some exist in a tree
        assertEquals($tree->contains(10), true);
        assertEquals($tree->contains(20), true);
        assertEquals($tree->contains(40), false);

        assertEquals($tree->search(20)->getValue(), "Twenty");
        assertEquals($tree->search(5), null);

        // delete some nodes
        assertEquals($tree->delete(21), true);
        assertEquals($tree->delete(15), true);
        assertEquals($tree->delete(25), true);

        // check if nodes are actually deleted
        assertEquals($tree->contains(30), true);
        assertEquals($tree->contains(25), false);
        assertEquals($tree->contains(21), false);

        // checks if all nodes were deleted well
        assertEquals($tree->count(20), 4);

        // check if minimum and maximum nodes are found well
        assertEquals($tree->getMin()->getValue(), "Ten");
        assertEquals($tree->getMax()->getValue(), "Thirdy five");

        $tree->printTree();
    }
}
