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
class Yatzy
{
    public function index(): ResponseInterface
    {
        if (!isset($_SESSION["yatzy"])) {
            $_SESSION["yatzy"] = new \Manh20\Yatzy\Game();
        }
     
        $data = [
            "game" => $_SESSION["yatzy"],
            "checked_dice" => $_GET["dice"] ?? []
        ];

        $body = renderView("layout/yatzy.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function reset(): ResponseInterface
    {
        unset($_SESSION["yatzy"]);

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function roll(): ResponseInterface
    {
        $_SESSION["yatzy"]->roll($_POST["dice"] ?? null);

        $query = http_build_query([
            "dice" => $_POST["dice"] ?? []
        ]);

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy?$query"));
    }

    public function store(): ResponseInterface
    {
        if ($_POST["action"] === "strike") {
            $_SESSION["yatzy"]->strike($_POST["row"]);
        } else
        if ($_POST["action"] === "store") {
            $_SESSION["yatzy"]->store($_POST["row"]);
        }

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }
}
