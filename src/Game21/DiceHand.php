<?php

declare(strict_types=1);

namespace Manh20\Game21;

class DiceHand {
  private int $dice_sides = 6;
  private int $dice_count;
  private array $dice = [];

  public function __construct($dice_count) {
    $this->set_dice_count($dice_count);
  }

  public function set_dice_count(int $dice_count) {
    $this->dice_count = $dice_count;

    $this->dice = [];

    for ($i = 0; $i < $dice_count; $i++) {
      $dice = new GraphicalDice($this->dice_sides);
      array_push($this->dice, $dice);
    }
  }

  public function get_dice_count() {
    return $this->dice_count;
  }

  public function get_dice() {
    return $this->dice;
  }

  public function roll() {
    foreach ($this->dice as $dice) {
      $dice->roll();
    }

    return $this->dice;
  }

  public function get_last_results() {
    return array_map(function ($dice) {
      return $dice->get_last_roll();
    }, $this->dice);
  }

  public function get_last_result() {
    $results = $this->get_last_results();

    return array_sum($results);
  }
}
