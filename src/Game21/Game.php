<?php

declare(strict_types=1);

namespace Manh20\Game21;

use Manh20\Game21\{
  DiceHand
};

class Game {
  private int $points_player = 0;
  private int $points_computer = 0;
  private ?int $dice_count = null;
  private $hand;

  private int $wins_player = 0;
  private int $wins_computer = 0;

  private ?string $winner = null;

  public function get_hand() {
    return $this->hand;
  }

  public function set_dice_count($dice_count) {
    $this->dice_count = $dice_count;

    $this->hand = new DiceHand($dice_count);
  }

  public function get_dice_count() {
    return $this->dice_count;
  }

  public function get_wins_player() {
    return $this->wins_player;
  }

  public function get_wins_computer() {
    return $this->wins_computer;
  }

  public function get_points_player() {
    return $this->points_player;
  }

  public function get_points_computer() {
    return $this->points_computer;
  }

  public function roll() {
    $this->hand->roll();

    $result = $this->hand->get_last_result();

    $this->points_player += $result;

    if ($this->points_player === 21) {
      $this->set_winner_player();
    } else if ($this->points_player > 21) {
      $this->set_winner_computer();
    }
  }

  public function set_winner_player() {
    $this->winner = "player";
    $this->wins_player += 1;
  }

  public function set_winner_computer() {
    $this->winner = "computer";
    $this->wins_computer += 1;
  }

  public function clear_winner() {
    $this->winner = null;
  }
  
  public function get_winner() {
    return $this->winner;
  }

  public function play_computer() {
    while ($this->points_computer < 21) {
      $this->hand->roll();

      $result = $this->hand->get_last_result();

      $this->points_computer += $result;

      if ($this->points_computer > 21) {
        break;
      }

      $beat_player = $this->points_computer >= $this->points_player;
      $beat_game = $this->points_computer === 21;

      if ($beat_player || $beat_game) {
        $this->set_winner_computer();
        return;
      }
    }

    $this->set_winner_player();
  }

  public function next_round() {
    $this->clear_winner();

    $this->points_player = 0;
    $this->points_computer = 0;
  }
}
