<?php

declare(strict_types=1);

namespace Manh20\Game21;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Game21 Dice class.
 */
class DiceTest extends TestCase
{
    /**
     * Try to create the class.
     */
    public function testCreateTheClass()
    {
        $dice = new Dice(6);
        $this->assertInstanceOf("\Manh20\Game21\Dice", $dice);
    }

    /**
     * Try to get and set the sides.
     * If you're concerned about testing multiple things here:
     * https://stackoverflow.com/a/5937899
     */
    public function testGetSetSides()
    {
        $dice = new Dice(6);
        $dice->set_sides(5);
        
        $this->assertEquals($dice->get_sides(), 5);
    }

    /**
     * Try to roll.
     */
    public function testRoll()
    {
        $dice = new Dice(6);
        $res = $dice->roll();
        
        $this->assertEquals($res, $dice->get_last_roll());
    }
}
