<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Mos\Functions\{
  url
};

?>

<h1>Yatzy</h1>

<form method="POST" action="<?= url("/yatzy/reset") ?>">
  <button type="submit">Reset</button>
</form>

<br>

<table class="yatzy-board-table">
  <tbody>
    <?php foreach ($game->get_board()->get_rows() as $id => $row) { ?>
      <tr>
        <td><?= $row["text"] ?></td>
        <td><?= $row["display_value"] ?></td>
        <td>
          <form method="POST" action="<?= url("/yatzy/store") ?>">
            <input type="hidden" name="row" value="<?= $id ?>">
  
            <?php if ($row["value"] === null) { ?>
              <button name="action" value="strike">Strike</button>
            <?php } ?>
  
            <?php if ($game->can_store($id)) { ?>
              <button name="action" value="store">Choose (<?= $game->get_row_potential($id) ?>)</button>
            <?php } ?>
          </form>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<p>Rolls left: <?= $game->get_rolls_left() ?></p>

<form method="POST" action="<?= url("/yatzy/roll") ?>">
  <div class="yatzy-dice-set">
    <?php foreach ($game->get_dice() as $i => $dice) { ?>
      <div class="yatzy-dice-set__dice">
        <label for="dice_<?= $i ?>">
          <pre><?= $dice->draw() ?></pre>
        </label>
        <?php if ($game->get_roll() > 0 && $game->can_roll()) { ?>
          <input
            type="checkbox"
            id="dice_<?= $i ?>"
            name="dice[]"
            value="<?= $i ?>"
            <?= in_array($i, $checked_dice) ? "checked" : "" ?>
          >
        <?php } ?>
      </div>
    <?php } ?>
  </div>

  <br>

  <?php if ($game->can_roll()) { ?>
    <button type="submit">Roll dice</button>
    <small>Checked dice will be kept</small>
  <?php } ?>
</form>

<br>
<br>
