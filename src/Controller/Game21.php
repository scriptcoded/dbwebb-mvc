<?php

declare(strict_types=1);

namespace Manh20\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller showing how to work with forms.
 */
class Game21
{
    public function index(): ResponseInterface
    {
        if (!isset($_SESSION["game21"])) {
            $_SESSION["game21"] = new \Manh20\Game21\Game();
        }
     
        $data = [
            "game" => $_SESSION["game21"]
        ];

        $body = renderView("layout/game21.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function reset(): ResponseInterface
    {
        unset($_SESSION["game21"]);

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }

    public function set_dice(): ResponseInterface
    {
        $_SESSION["game21"]->set_dice_count(intval($_POST['dice']));

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }

    public function roll(): ResponseInterface
    {
        $_SESSION["game21"]->roll();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }

    public function stop(): ResponseInterface
    {
        $_SESSION["game21"]->play_computer();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }

    public function next_round(): ResponseInterface
    {
        $_SESSION["game21"]->next_round();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }
}
