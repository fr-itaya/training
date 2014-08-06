<?php
class AdderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider adderProvider
     */
    public function testAdder($x, $y, $expected)
    {
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
