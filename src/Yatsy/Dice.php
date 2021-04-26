<?php

declare(strict_types=1);

namespace Manh20\Yatsy;

class Dice {
  private int $sides;
  private ?int $last_roll = null;

  public function __construct($sides) {
    $this->set_sides($sides);
  }

  public function set_sides(int $sides) {
    $this->sides = $sides;
  }

  public function get_sides() {
    return $this->sides;
  }

  public function get_last_roll() {
    return $this->last_roll;
  }

  public function reset() {
    $this->last_roll = null;
  }

  public function roll() {
    $this->last_roll = random_int(1, $this->sides);

    return $this->last_roll;
  }

  public static function draw_dice($result) {
    $marker = "●";
    $spa = " ";

    $diaOn = $result > 1;
    $dibOn = $result > 3;
    $horOn = $result === 6;
    $cenOn = $result % 2 === 1;

    $dia = $diaOn ? $marker : $spa;
    $dib = $dibOn ? $marker : $spa;
    $hor = $horOn ? $marker : $spa;
    $cen = $cenOn ? $marker : $spa;

    return "╭───────╮\n".
           "│ $dia $spa $dib │\n" .
           "│ $hor $cen $hor │\n" .
           "│ $dib $spa $dia │\n" .
           "╰───────╯";
  }

  public function draw() {
    return $this::draw_dice($this->get_last_roll());
  }
}
