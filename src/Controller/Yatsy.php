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
class Yatsy
{
    public function index(): ResponseInterface
    {
        if (!isset($_SESSION["yatsy"])) {
            $_SESSION["yatsy"] = new \Manh20\Yatsy\Game();
        }
     
        $data = [
            "game" => $_SESSION["yatsy"],
            "checked_dice" => $_GET["dice"] ?? []
        ];

        $body = renderView("layout/yatsy.php", $data);

        $psr17Factory = new Psr17Factory();
        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function reset(): ResponseInterface
    {
        unset($_SESSION["yatsy"]);

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatsy"));
    }

    public function roll(): ResponseInterface
    {
        $_SESSION["yatsy"]->roll($_POST["dice"] ?? null);

        $query = http_build_query([
            "dice" => $_POST["dice"] ?? []
        ]);

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatsy?$query"));
    }

    public function store(): ResponseInterface
    {
        if ($_POST["action"] === "strike") {
            $_SESSION["yatsy"]->strike($_POST["row"]);
        } else
        if ($_POST["action"] === "store") {
            $_SESSION["yatsy"]->store($_POST["row"]);
        }

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatsy"));
    }
}
