<?php

declare(strict_types=1);

namespace Manh20\Game21;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Game21 DiceHand class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Try to create the class.
     */
    public function testCreateTheClass()
    {
        $hand = new DiceHand(3);
        $this->assertInstanceOf("\Manh20\Game21\DiceHand", $hand);
    }

    /**
     * Try to get and set the dice count.
     * If you're concerned about testing multiple things here:
     * https://stackoverflow.com/a/5937899
     */
    public function testGetSetDiceCount()
    {
        $hand = new DiceHand(3);
        $hand->set_dice_count(4);
        
        $this->assertEquals($hand->get_dice_count(), 4);
    }

    /**
     * Try to get dice.
     */
    public function testGetDice()
    {
        $hand = new DiceHand(3);
        $res = $hand->get_dice();
        
        $this->assertIsArray($res);
        $this->assertCount(3, $res);
    }

    /**
     * Try to roll dice.
     */
    public function testRoll()
    {
        $hand = new DiceHand(3);
        $res = $hand->roll();
        
        $this->assertIsArray($res);
        $this->assertCount(3, $res);
    }

    /**
     * Try to get last result.
     */
    public function testGetLastResult()
    {
        $hand = new DiceHand(3);
        $res = $hand->get_last_result();
        
        $this->assertEquals($res, 0);
    }
}
