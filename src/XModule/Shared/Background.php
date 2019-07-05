<?php

namespace XModule;

use \XModule\Traits\WithUrl;

class Background
{
  use WithUrl;

  public function __construct(string $url)
  {
    self::initUrl(['url' => $url]);
  }

  public function render()
  {
    $render = [];
    self::renderUrl($render);
    return $render;
  }
}
