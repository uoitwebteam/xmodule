<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithUrl;

class CarouselItemImage extends Element
{
  use WithUrl;

  public function __construct(string $url)
  {
    parent::__construct(ElementType::CAROUSEL_ITEM_IMAGE);

    self::initUrl(['url' => $url]);
  }

  public function render()
  {
    $render = parent::render();

    self::renderUrl($render);

    return $render;
  }
}
