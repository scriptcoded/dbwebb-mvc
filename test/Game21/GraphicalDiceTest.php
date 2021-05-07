<?php

declare(strict_types=1);

namespace Manh20\Game21;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Game21 GraphicalDice class.
 */
class GraphicalDiceTest extends TestCase
{
    /**
     * Try to create the class.
     */
    public function testCreateTheClass()
    {
        $dice = new GraphicalDice(6);
        $this->assertInstanceOf("\Manh20\Game21\GraphicalDice", $dice);
    }

    /**
     * Try render.
     */
    public function testRender()
    {
        $dice = new GraphicalDice(6);
        $res = $dice->render();

        $this->assertStringStartsWith("<pre>╭", $res);
    }
}
