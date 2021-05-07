<?php

declare(strict_types=1);

namespace Manh20\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Game21.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21();
        $this->assertInstanceOf("\Manh20\Controller\Game21", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        session_start();
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    public function testDestroySession()
    {
        session_start();
        $controller = new Game21();

        $_SESSION = [
            "game21" => "Snakes! I hate snakes!"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->reset();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }

    /**
     * Set the dice.
     * @runInSeparateProcess
     */
    public function testSetDice()
    {
        // We only test that we get a response here as the other tests test the
        // actuall game class

        session_start();
        $controller = new Game21();
        $_SESSION["game21"] = new \Manh20\Game21\Game();

        $_POST["dice"] = "3";

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->set_dice();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Roll the dice
     * @runInSeparateProcess
     */
    public function testRoll()
    {
        // We only test that we get a response here as the other tests test the
        // actuall game class

        session_start();
        $controller = new Game21();
        $_SESSION["game21"] = new \Manh20\Game21\Game();
        $_SESSION["game21"]->set_dice_count(3);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->roll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Stop rolling
     * @runInSeparateProcess
     */
    public function testStop()
    {
        // We only test that we get a response here as the other tests test the
        // actuall game class

        session_start();
        $controller = new Game21();
        $_SESSION["game21"] = new \Manh20\Game21\Game();
        $_SESSION["game21"]->set_dice_count(3);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->stop();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Start the next round
     * @runInSeparateProcess
     */
    public function testNextRound()
    {
        // We only test that we get a response here as the other tests test the
        // actuall game class

        session_start();
        $controller = new Game21();
        $_SESSION["game21"] = new \Manh20\Game21\Game();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->next_round();
        $this->assertInstanceOf($exp, $res);
    }
}
