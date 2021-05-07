<?php

declare(strict_types=1);

namespace Manh20\Game21;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for the Game21 Game class.
 */
class GameTest extends TestCase
{
    /**
     * Try to create the class.
     */
    public function testCreateTheClass()
    {
        $game = new Game();
        $this->assertInstanceOf("\Manh20\Game21\Game", $game);
    }

    /**
     * Try set and get dice count.
     */
    public function testSetGetDiceCount()
    {
        $game = new Game();
        $game->set_dice_count(3);

        $this->assertEquals($game->get_dice_count(), 3);
    }

    /**
     * Try to get the hand.
     */
    public function testGetHand()
    {
        $game = new Game();
        $game->set_dice_count(3);
        $hand = $game->get_hand();

        $this->assertInstanceOf("\Manh20\Game21\DiceHand", $hand);
    }

    /**
     * Try to get wins player.
     */
    public function testGetWinsPlayer()
    {
        $game = new Game();
        $res = $game->get_wins_player();

        $this->assertEquals($res, 0);
    }

    /**
     * Try to get wins computer.
     */
    public function testGetWinsComputer()
    {
        $game = new Game();
        $res = $game->get_wins_computer();

        $this->assertEquals($res, 0);
    }

    /**
     * Try to get points player.
     */
    public function testGetPointsPlayer()
    {
        $game = new Game();
        $res = $game->get_points_player();

        $this->assertEquals($res, 0);
    }

    /**
     * Try to get points computer.
     */
    public function testGetPointsComputer()
    {
        $game = new Game();
        $res = $game->get_points_computer();

        $this->assertEquals($res, 0);
    }

    /**
     * Try to roll.
     */
    public function testRollPlayer()
    {
        $handStub = $this->createMock(DiceHand::class);
        $handStub->set_dice_count(6);
        $handStub
            ->method("get_last_result")
            ->willReturn(21);

        $game = new Game();
        $game->hand = $handStub;

        $game->roll();
        $res = $game->get_points_player();

        $this->assertEquals(21, $res);
    }

    /**
     * Try to roll.
     */
    public function testRollComputer()
    {
        $handStub = $this->createMock(DiceHand::class);
        $handStub->set_dice_count(6);
        $handStub
            ->method("get_last_result")
            ->willReturn(22);

        $game = new Game();
        $game->hand = $handStub;

        $game->roll();
        $res = $game->get_points_player();

        $this->assertEquals(22, $res);
    }

    /**
     * Try not to clear winner.
     */
    public function testNotClearWinner()
    {
        $game = new Game();
        $game->set_dice_count(40);

        $game->roll();

        $this->assertNotNull($game->get_winner());
    }

    /**
     * Try to clear winner.
     */
    public function testClearWinner()
    {
        $game = new Game();
        $game->set_dice_count(40);

        $game->roll();
        $game->clear_winner();

        $this->assertNull($game->get_winner());
    }

    /**
     * Try to fail as computer.
     */
    public function testPlayComputerFail()
    {
        $game = new Game();
        $game->set_dice_count(40);

        $game->play_computer();
        
        $this->assertEquals($game->get_winner(), "player");
    }

    /**
     * Try to play as computer.
     */
    public function testPlayComputer()
    {
        $game = new Game();
        $game->set_dice_count(1);

        $game->play_computer();
        
        $this->assertEquals($game->get_winner(), "computer");
    }

    /**
     * Try next round.
     */
    public function testNextRound()
    {
        $game = new Game();
        $game->set_dice_count(40);

        $game->roll();
        $game->next_round();
        
        $this->assertNull($game->get_winner());
        $this->assertEquals($game->get_points_player(), 0);
        $this->assertEquals($game->get_points_computer(), 0);
    }
}
