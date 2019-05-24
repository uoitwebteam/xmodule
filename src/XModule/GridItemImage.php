<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithBadge;
use \XModule\Traits\WithUrl;

const DEFAULT_GRID_ITEM_IMAGE_OPTIONS = [
  'badge' => null,
];

class GridItemImage extends Element
{
  use WithUrl, WithBadge;

  public function __construct(string $url, array $options = DEFAULT_GRID_ITEM_IMAGE_OPTIONS)
  {
    parent::__construct(ElementType::GRID_ITEM_IMAGE);

    self::initUrl(['url' => $url]);
    self::initBadge($options);
  }

  public function render()
  {
    $render = parent::render();

    self::renderUrl($render);
    self::renderBadge($render);

    return $render;
  }
}
