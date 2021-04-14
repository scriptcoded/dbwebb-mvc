<?php

declare(strict_types=1);

namespace Manh20\Game21;

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

  public function roll() {
    $this->last_roll = random_int(1, $this->sides);

    return $this->last_roll;
  }
}
