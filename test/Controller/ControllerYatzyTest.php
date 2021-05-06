<?php

declare(strict_types=1);

namespace Manh20\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Yatzy.
 */
class ControllerYatzyTest extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Yatzy();
        $this->assertInstanceOf("\Manh20\Controller\Yatzy", $controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerReturnsResponse()
    {
        session_start();
        $controller = new Yatzy();

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
        $controller = new Yatzy();

        $_SESSION = [
            "yatzy" => "Snakes! I hate snakes!"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->reset();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }

    /**
     * Roll the dice.
     * @runInSeparateProcess
     */
    public function testRollDice()
    {
        // We only test that we get a response here as the other tests test the
        // actuall game class

        session_start();
        $controller = new Yatzy();
        $_SESSION["yatzy"] = new \Manh20\Yatzy\Game();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->roll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Strike the roll
     * @runInSeparateProcess
     */
    public function testStrikeRoll()
    {
        // We only test that we get a response here as the other tests test the
        // actuall game class

        session_start();
        $controller = new Yatzy();
        $_SESSION["yatzy"] = new \Manh20\Yatzy\Game();

        $_POST["action"] = "strike";
        $_POST["row"] = "ones";

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->store();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Store the roll
     * @runInSeparateProcess
     */
    public function testStoreRoll()
    {
        // We only test that we get a response here as the other tests test the
        // actuall game class

        session_start();
        $controller = new Yatzy();
        $_SESSION["yatzy"] = new \Manh20\Yatzy\Game();

        $_POST["action"] = "store";
        $_POST["row"] = "ones";

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->store();
        $this->assertInstanceOf($exp, $res);
    }
}
