<?php

namespace XModule\XComponent;

use \XModule\Traits\WithBackground;
use \XModule\Traits\WithForeground;
use \XModule\Traits\WithLink;
use \XModule\Traits\WithSubtitle;
use \XModule\Traits\WithTitle;

const DEFAULT_CAROUSEL_ITEM_OPTIONS = [
  'title' => null,
  'subtitle' => null,
  'link' => null,
  'foreground' => null,
  'background' => null,
];

class CarouselItem
{
  use WithSubtitle, WithTitle, WithLink, WithBackground, WithForeground;

  public function __construct(array $options = DEFAULT_CAROUSEL_ITEM_OPTIONS)
  {
    self::initLink($options);
    self::initTitle($options);
    self::initSubtitle($options);
    self::initBackground($options);
    self::initForeground($options);
  }

  public function render()
  {
    $render = [];

    self::renderLink($render);
    self::renderTitle($render);
    self::renderSubtitle($render);
    self::renderBackground($render);
    self::renderForeground($render);

    return $render;
  }
}
