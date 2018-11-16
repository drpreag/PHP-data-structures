# PHP data structures
Advanced PHP data structures, linked lists, trees, etc

## DLL - Double linked list

Linked list with 2 pointers in each Node, to previous and next Node. Also in DLL class itself are stored pointers to head and tail in Node in collection. DLL is aways sorted in this implementation, because on insertion new node is added in a place that it keeps array sorted.

Classes:
 
    > DLL_node (represents a Node)
    > DLL (represents a Doubled Linked List)

Look at tests/DLL_Test.php for a primer how to use.

## AVL - AVL or Binary Search Tree

Named after inventors Adelson-Velsky and Landis, this structure  is also known as Balanced Binary Search Tree or BBST. Very fast on search, insert and delete operations.

Tree starts with root node, every node has left and right child. Every left child is smaller then node, every right child is greater then node. AVL tree is auto sorted on insertion and deletion, and also auto balanced on insertion and deletion by keeping similar height on left and right side on each node in tree.

Classes:
 
    > AVL_node (represents a Node)
    > AVL (represents a AVL tree)

Look at tests/AVL_Test.php for a primer how to use.