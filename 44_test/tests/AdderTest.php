<?php
require_once __DIR__ . '/../adder.php';

class AdderTest extends PHPUnit_Framework_TestCase
{
    public $adder;

    public function setUp()
    {
        $this->adder = new Adder;
    }

    /**
     * @dataProvider adderProvider
     */

    public function testAdd($x, $y, $expected)
    {
        $this->adder->add($x, $y);
        $this->assertEquals($expected, $x + $y);
    }

    public function adderProvider()
    {
        return array(
            array(1, 2, 3),
            array(1, -2, -1),
            array(1, 1.5, 2.5)
        );
    }
}
