<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\WithDescription;
use \XModule\Constants\WithLineAlpha;
use \XModule\Constants\WithLineColor;
use \XModule\Constants\WithLineWidth;
use \XModule\Constants\WithLink;
use \XModule\Constants\WithTitle;
use \XModule\Maps\Point;
use \XModule\Shared\Functions;

const DEFAULT_MAP_POLYLINE_OPTIONS = [
  'title' => null,
  'description' => null,
  'link' => null,
  'lineColor' => '#666666',
  'lineAlpha' => 0.8,
  'lineWidth' => 3,
];

class MapPolyline extends Element
{
  use WithDescription, WithLink, WithTitle, WithLineColor, WithLineAlpha, WithLineWidth;
  private $polyline;

  public function __construct(array $polyline, array $options = DEFAULT_MAP_POLYLINE_OPTIONS)
  {
    parent::__construct(ElementType::MAP_POLYLINE);

    $this->setPolyline($polyline);

    $this->initDescription($options);
    $this->initLink($options);
    $this->initTitle($options);
    $this->initLineColor($options);
    $this->initLineAlpha($options);
    $this->initLineWidth($options);
  }

  public function setPolyline(array $polyline)
  {
    foreach ($polyline as $point) {
      $this->addPolylinePoint($point);
    }
  }

  public function addPolylinePoint(Point $point)
  {
    if (!$this->polyline) {
      $this->polyline = [];
    }
    array_push($this->polyline, $point);
  }

  public function render()
  {
    $render = parent::render();
    $render['polyline'] = Functions::safeRender($this->polyline);

    $this->renderDescription($render);
    $this->renderLink($render);
    $this->renderTitle($render);
    $this->renderLineColor($render);
    $this->renderLineAlpha($render);
    $this->renderLineWidth($render);

    return $render;
  }
}
