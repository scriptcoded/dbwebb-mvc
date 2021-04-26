<?php

declare(strict_types=1);

namespace Manh20\Yatsy;

class Game {
  private $board;

  private array $dice;

  private int $max_rolls = 3;
  private int $roll = 0;

  public function __construct() {
    $this->dice = [
      new Dice(6),
      new Dice(6),
      new Dice(6),
      new Dice(6),
      new Dice(6)
    ];

    $this->board = new Board();
  }

  public function get_board() {
    return $this->board;
  }

  public function get_dice() {
    return $this->dice;
  }

  public function get_roll() {
    return $this->roll;
  }

  public function get_rolls_left() {
    return $this->max_rolls - $this->roll;
  }

  public function get_rolls() {
    $rolls = [];

    foreach ($this->dice as $dice) {
      array_push($rolls, $dice->get_last_roll());
    }

    return $rolls;
  }


  public function roll($indices) {
    $indices = $indices ?? [];
    $this->roll += 1;

    foreach ($this->dice as $i => $dice) {
      if (!in_array($i, $indices)) {
        $dice->roll();
      }
    }
  }

  public function can_store($row_id) {
    $rolls = $this->get_rolls();

    return $this->board->can_store($row_id, $rolls);
  }

  public function strike($row_id) {
    $this->board->set_score($row_id, []);
    $this->new_round();
  }

  public function store($row_id) {
    $this->board->set_score($row_id, $this->get_rolls());
    $this->new_round();
  }

  public function can_roll() {
    return $this->get_rolls_left() > 0;
  }

  public function get_row_potential($row_id) {
    $rolls = $this->get_rolls();

    return $this->board->get_row_potential($row_id, $rolls);
  }

  private function new_round() {
    $this->roll = 0;
    
    foreach ($this->dice as $dice) {
      $dice->reset();
    }
  }
}
