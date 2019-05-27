<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\WithDescription;
use \XModule\Constants\WithLink;
use \XModule\Constants\WithTitle;
use \XModule\Maps\Icon;
use \XModule\Maps\Point;
use \XModule\Shared\Functions;

const DEFAULT_MAP_POINT_OPTIONS = [
  'point' => null,
  'title' => null,
  'description' => null,
  'link' => null,
  'icon' => null,
];

class MapPoint extends Element
{
  use WithDescription, WithLink, WithTitle;
  private $point;
  private $icon;

  public function __construct(Point $point, array $options = DEFAULT_MAP_POINT_OPTIONS)
  {
    parent::__construct(ElementType::MAP_POINT);

    $this->setPoint($point);

    $this->initDescription($options);
    $this->initLink($options);
    $this->initTitle($options);

    if (isset($options['icon'])) {
      $this->setIcon($options['icon']);
    }
  }

  public function setPoint(Point $point)
  {
    $this->point = $point;
  }

  public function setIcon(Icon $icon)
  {
    $this->icon = $icon;
  }

  public function render()
  {
    $render = parent::render();
    $render['point'] = Functions::safeRender($this->point);

    $this->renderDescription($render);
    $this->renderLink($render);
    $this->renderTitle($render);

    if (isset($this->icon)) {
      $render['icon'] = Functions::safeRender($this->icon);
    }

    return $render;
  }
}
