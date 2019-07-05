<?php

namespace XModule\XComponent;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\LayoutType;
use \XModule\Constants\ModuleType;
use \XModule\Traits\WithBackground;
use \XModule\Traits\WithForeground;
use \XModule\Traits\WithLink;
use \XModule\Traits\WithSubtitle;

const DEFAULT_CONTENT_TILE_OPTIONS = [
  'foreground' => null,
  'background' => null,
  'title' => null,
  'subtitle' => null,
  'link' => null,
  'linkText' => null,
];

class Hero extends Element
{
  use WithSubtitle, WithTitle, WithLink, WithBackground, WithForeground;

  public function __construct(array $options = DEFAULT_CONTENT_TILE_OPTIONS)
  {
    parent::__construct([ModuleType::PUBLISH, LayoutType::COLLAGE, ElementType::HERO]);

    self::initLink($options);
    self::initTitle($options);
    self::initSubtitle($options);
    self::initBackground($options);
    self::initForeground($options);
  }

  public function render()
  {
    $render = parent::render();

    self::renderLink($render);
    self::renderTitle($render);
    self::renderSubtitle($render);
    self::renderBackground($render);
    self::renderForeground($render);

    return $render;
  }
}
