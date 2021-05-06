<?php

declare(strict_types=1);

namespace Manh20\Yatzy;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Yatzy Game class.
 */
class GameTest extends TestCase
{
    /**
     * Try to create the class.
     */
    public function testCreateTheClass()
    {
        $game = new Game();
        $this->assertInstanceOf("\Manh20\Yatzy\Game", $game);
    }
    
    /**
     * Try get row potential.
     */
    public function testGetRowPotential()
    {
        $game = new Game();
        $res = $game->get_row_potential("ones");

        $this->assertEmpty($res);
    }
}
