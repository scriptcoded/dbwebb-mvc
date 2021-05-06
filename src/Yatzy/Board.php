<?php

declare(strict_types=1);

namespace Manh20\Yatzy;

use function Manh20\Util\mb_str_pad;

mb_internal_encoding("utf-8");

class Board {
  private function single_score_filter ($rolls, $score) {
    $valid_rolls = [];
  
    foreach ($rolls as $roll) {
      if ($roll === $score) {
        array_push($valid_rolls, $roll);
      }
    }
  
    return $valid_rolls;
  }

  private function get_row_types () {
    return [
      "ones" => [
        "text" => "1 ⚀",
        "filter" => function ($rolls) { return $this->single_score_filter($rolls, 1); }
      ],
      "twos" => [
        "text" => "2 ⚁",
        "filter" => function ($rolls) { return $this->single_score_filter($rolls, 2); }
      ],
      "threes" => [
        "text" => "3 ⚂",
        "filter" => function ($rolls) { return $this->single_score_filter($rolls, 3); }
      ],
      "fours" => [
        "text" => "4 ⚃",
        "filter" => function ($rolls) { return $this->single_score_filter($rolls, 4); }
      ],
      "fives" => [
        "text" => "5 ⚄",
        "filter" => function ($rolls) { return $this->single_score_filter($rolls, 5); }
      ],
      "sixes" => [
        "text" => "6 ⚅",
        "filter" => function ($rolls) { return $this->single_score_filter($rolls, 6); }
      ]
    ];
  }
  
  private $row_scores = [
    "ones" => null,
    "twos" => null,
    "threes" => null,
    "fours" => null,
    "fives" => null,
    "sixes" => null
  ];

  public function get_rows() {
    $rows = [];
    
    foreach ($this->get_row_types() as $id => $type) {
      $rows[$id] = [
        "text" => $type["text"],
        "value" => $this->row_scores[$id],
        "display_value" => $this->row_scores[$id] === 0 ? "╶╴" : $this->row_scores[$id]
      ];
    }

    return $rows;
  }

  private function get_drawn_score($score) {
    if ($score === null) { return "  "; }
    if ($score === 0) { return "╶╴"; }
    
    return str_pad(strval($score), 2, " ", STR_PAD_LEFT);
  }

  // This fancy function is never used :'(
  // Terminal based version, anyone? :)
  public function draw() {
    $text_lengths = array_map(function ($type) {
      return mb_strlen($type["text"]);
    }, $this->get_row_types());
    $max_text_length = max($text_lengths);

    $text_line = str_repeat("─", $max_text_length);

    $output = "╭─{$text_line}─┬────╮\n";

    foreach ($this->get_row_types() as $id => $type) {
      $score = $this->row_scores[$id];
      $drawn_score = $this->get_drawn_score($score);

      $padded_text = mb_str_pad($type["text"], $max_text_length);

      $output .= "│ $padded_text │ $drawn_score │\n";
    }

    $output .= "╰─{$text_line}─┴────╯";

    return $output;
  }

  public function can_store($row_id, $rolls) {
    $type = $this->get_row_types()[$row_id];
    $score = $this->row_scores[$row_id];

    return $score === null && count($type["filter"]($rolls)) > 0;
  }

  public function get_row_potential($row_id, $rolls) {
    $type = $this->get_row_types()[$row_id];
    $valid_rolls = $type["filter"]($rolls);

    return array_sum($valid_rolls);
  }

  public function set_score($row_id, $rolls) {
    $this->row_scores[$row_id] = $this->get_row_potential($row_id, $rolls);
  }
}
