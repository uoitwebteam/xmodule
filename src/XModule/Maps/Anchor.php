<?php

namespace XModule\Maps;

use \XModule\Constants\AnchorPosition;

const DEFAULT_ANCHOR_OPTIONS = [
  'x' => null,
  'y' => null,
];

class Anchor
{
  private $x;
  private $y;

  public function __construct(array $options = DEFAULT_ANCHOR_OPTIONS)
  {
    if (isset($options['x'])) {
      $this->setX($options['x']);
    }
    if (isset($options['y'])) {
      $this->setY($options['y']);
    }
  }

  public function setX(string $x)
  {
    $this->x = AnchorPosition::validate($x, 'anchor');
  }

  public function setY(string $y)
  {
    $this->y = AnchorPosition::validate($y, 'anchor');
  }

  public function render()
  {
    $render = [];

    if (isset($this->x)) {
      $render['x'] = $this->x;
    }
    if (isset($this->y)) {
      $render['y'] = $this->y;
    }

    return $render;
  }
}
