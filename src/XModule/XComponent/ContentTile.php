<?php

namespace XModule\XComponent;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\LayoutType;
use \XModule\Constants\ModuleType;
use \XModule\Traits\WithBackground;
use \XModule\Traits\WithBadge;
use \XModule\Traits\WithForeground;
use \XModule\Traits\WithLink;
use \XModule\Traits\WithSubtitle;

const DEFAULT_CONTENT_TILE_OPTIONS = [
  'foreground' => null,
  'background' => null,
  'title' => null,
  'subtitle' => null,
  'link' => null,
  'badge' => null,
];

class ContentTile extends Element
{
  use WithSubtitle, WithTitle, WithLink, WithBadge, WithBackground, WithForeground;

  public function __construct(array $options = DEFAULT_CONTENT_TILE_OPTIONS)
  {
    parent::__construct([ModuleType::PUBLISH, LayoutType::MONDRIAN, ElementType::CONTENT_TILE]);

    self::initLink($options);
    self::initTitle($options);
    self::initSubtitle($options);
    self::initBadge($options);
    self::initBackground($options);
    self::initForeground($options);
  }

  public function render()
  {
    $render = parent::render();

    self::renderLink($render);
    self::renderTitle($render);
    self::renderSubtitle($render);
    self::renderBadge($render);
    self::renderBackground($render);
    self::renderForeground($render);

    return $render;
  }
}
