<?php
namespace PHPDataStructures;
/**
 * Class DLL_Node
 *
 * Node class for DLL (Double Linked List)
 *
 * DLL_Node can store: <int> $key, <any type> $value,
 *
 * For storing key/value pars, key is integer, and value can be ANY object
 *
 * public methods:
 *
 * __construct (int $key, $value)
 * getKey () : int
 * setKey (int $key)
 * getValue ()
 * setValue ($value)
 * getNext () : DDL_Node
 * setNext (DLL_Node $next)
 * getPrev () : DDL_Node
 * setPrev (DLL_Node $prev)
 * toString () : string
 *
 */

class DLL_Node
{
    protected $key;
    protected $value;
    protected $next;
    protected $prev;

    public function __construct (int $key, $value) {
        $this->key = $key;
        $this->value = $value;
        $this->next = $this->prev = null;
    }

    /**
     * @return mixed
     */
    public function getKey() : int
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     */
    public function setKey(int $key)
    {
        $this->key = $key;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param mixed $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @return mixed
     */
    public function getPrev()
    {
        return $this->prev;
    }

    /**
     * @param mixed $prev
     */
    public function setPrev($prev)
    {
        $this->prev = $prev;
    }

    public function toString () : string {
        return "Key: $this->key; Value: $this->value; " .
            "Previous: " . ($this->prev?$this->prev->key:"") . "; " .
            "Next: " . ($this->next?$this->next->key:""). "\n";
    }
}