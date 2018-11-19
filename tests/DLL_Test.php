<?php
namespace PHPDataStructures;

use PHPUnit\Framework\TestCase;

class DLL_Test extends TestCase
{

    public function test_DLL_basics()
    {
        $dll = new DLL;

        $dll->add("20", "Twenty");
        $dll->add("10", "Ten");
        $dll->add("30", "Thirty");
        $dll->add("50", "Fifty");
        $dll->add("40", "Forty");
        $dll->add("45", "Forty five");
        $dll->add("60", "Sixty");
        $dll->add("25", "Twenty five");

        assertEquals($dll->count(), 8);

        assertEquals($dll->contains(45)->getKey(), 45);
        assertEquals($dll->contains(10)->getValue(), "Ten");

        $dll->delete(45);
        assertEquals($dll->contains(45), false);

        $dll->delete(10);
        assertEquals($dll->contains(10), false);

        assertEquals($dll->contains(20)->getKey(), 20);
        assertEquals($dll->contains(30)->getValue(), "Thirty");

        assertEquals($dll->getMax(), 60);
        assertEquals($dll->getMin(), 20);

        $dll->printList();
    }
}
