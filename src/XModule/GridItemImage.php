<?php

namespace XModule;

use \XModule\Traits\WithBadge;
use \XModule\Traits\WithUrl;

const DEFAULT_GRID_ITEM_IMAGE_OPTIONS = [
  'badge' => null,
];

class GridItemImage
{
  use WithUrl, WithBadge;

  public function __construct(string $url, array $options = DEFAULT_GRID_ITEM_IMAGE_OPTIONS)
  {
    self::initUrl(['url' => $url]);
    self::initBadge($options);
  }

  public function render()
  {
    $render = [];

    self::renderUrl($render);
    self::renderBadge($render);

    return $render;
  }
}
