# PHP data structures
Advanced PHP data structures, linked lists, trees, etc

## DLL - Double linked list

Linked list with 2 pointers in each Node, 
to previous and next Node. Also in DLL class itself are 
stored pointers to head and tail in Node in collection.
DLL is aways sorted in this implementation, because
on insertion new node is added in a place that it keeps 
array sorted.

Classes:
 
    > DLL_Node (represents a Node)
    > DLL (represents a Doubled Linked List)

Look at tests/DLL_Test.php for details how to use.