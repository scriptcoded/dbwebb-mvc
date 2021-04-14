<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\{
  url
};

?>

<h1>Game 21</h1>

<form method="POST" action="<?= url("/game21/reset") ?>">
  <button type="submit">Reset</button>
</form>

<br>


<?php if (!$game->get_dice_count()) { ?>
  <form method="POST" action="<?= url("/game21/set-dice") ?>">
    <button type="submit" name="dice" value="1">Play with 1 dice</button>
    <button type="submit" name="dice" value="2">Play with 2 dice</button>
  </form>
<?php } else { ?>
  <table>
    <tbody>
      <tr>
        <th>Points player</th>
        <td><?= $game->get_points_player() ?></td>
      </tr>
      <tr>
        <th>Points computer</th>
        <td><?= $game->get_points_computer() ?></td>
      </tr>
      <tr>
        <th>Wins player</th>
        <td><?= $game->get_wins_player() ?></td>
      </tr>
      <tr>
        <th>Wins computer</th>
        <td><?= $game->get_wins_computer() ?></td>
      </tr>
    </tbody>
  </table>

  <?php if ($game->get_winner()) { ?>
    <?php if ($game->get_winner() === "player") { ?>
      <h3>Congratulations! You won!</h3>
    <?php } else if ($game->get_winner() === "computer") { ?>
      <h3>Oh no! You lost!</h3>
    <?php } ?>

    <form method="POST" action="<?= url("/game21/next-round") ?>">
      <button type="submit">Next round</button>
    </form>
  <?php } else { ?>
    <div class="clearfix">
      <?php foreach ($game->get_hand()->get_dice() as $dice) { ?>
        <span style="float: left;">
          <?= $dice->render() ?>
        </span>
      <?php } ?>
    </div>

    <form method="POST" action="<?= url("/game21/roll") ?>">
      <button type="submit">Roll</button>
    </form>
    <form method="POST" action="<?= url("/game21/stop") ?>">
      <button type="submit">Stop</button>
    </form>
  <?php } ?>
<?php } ?>
