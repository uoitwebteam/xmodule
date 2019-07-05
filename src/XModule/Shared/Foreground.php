<?php

namespace XModule;

use \XModule\Traits\WithUrl;

const DEFAULT_FOREGROUND_OPTIONS = [
  'alt' => null,
];

class Foreground
{
  use WithUrl;
  private $alt;

  public function __construct(string $url, array $options = DEFAULT_FOREGROUND_OPTIONS)
  {
    self::initUrl(['url' => $url]);

    if (isset($options['alt'])) {
      $this->setAlt($options['alt']);
    }
  }

  public function setAlt(string $alt)
  {
    $this->alt = $alt;
  }

  public function render()
  {
    $render = [];
    self::renderUrl($render);

    if (isset($this->alt)) {
      $render['alt'] = $this->alt;
    }

    return $render;
  }
}
