<?php

declare(strict_types=1);

namespace Manh20\Yatzy;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Yatzy Board class.
 */
class BoardTest extends TestCase
{
    /**
     * Try to create the class.
     */
    public function testCreateTheClass()
    {
        $board = new Board();
        $this->assertInstanceOf("\Manh20\Yatzy\Board", $board);
    }

    /**
     * Try getting the rows
     */
    public function testGetRows()
    {
        $board = new Board();
        $rows = $board->get_rows();

        $this->assertEquals($rows, [
            "ones"   => [ "text" => "1 ⚀", "value" => null, "display_value" => null ],
            "twos"   => [ "text" => "2 ⚁", "value" => null, "display_value" => null ],
            "threes" => [ "text" => "3 ⚂", "value" => null, "display_value" => null ],
            "fours"  => [ "text" => "4 ⚃", "value" => null, "display_value" => null ],
            "fives"  => [ "text" => "5 ⚄", "value" => null, "display_value" => null ],
            "sixes"  => [ "text" => "6 ⚅", "value" => null, "display_value" => null ]
          ]);
    }

    /**
     * Try can store positive.
     */
    public function testCanStorePositive()
    {
        $board = new Board();
        $res = $board->can_store("ones", [1, 4, 1, ]);

        $this->assertTrue($res);
    }

    /**
     * Try can store negative.
     */
    public function testCanStoreNegative()
    {
        $board = new Board();
        $res = $board->can_store("ones", [2, 5, 2]);

        $this->assertFalse($res);
    }

    /**
     * Try set score.
     */
    public function testSetScore()
    {
        $board = new Board();
        $board->set_score("ones", [1, 4, 1]);

        $rows = $board->get_rows();

        $this->assertEquals($rows["ones"]["value"], 2);
    }

    /**
     * Try draw.
     */
    public function testDraw()
    {
        $board = new Board();
        $board->set_score("ones", [5, 2, 1]);
        $res = $board->draw();

        $this->assertStringStartsWith("╭", $res);
    }

    /**
     * Try get row potential.
     */
    public function testGetRowPotential()
    {
        $board = new Board();
        $res = $board->get_row_potential("ones", [1, 5, 3, 7, 1]);

        $this->assertEquals($res, 2);
    }
}
