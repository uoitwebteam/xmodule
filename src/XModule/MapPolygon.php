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

const DEFAULT_MAP_POLYGON_OPTIONS = [
  'title' => null,
  'description' => null,
  'link' => null,
  'lineColor' => '#666666',
  'lineAlpha' => 0.8,
  'lineWidth' => 3,
  'fillColor' => '#666666',
  'fillAlpha' => 0.5,
];

class MapPolygon extends Element
{
  use WithDescription, WithLink, WithTitle, WithLineColor, WithLineAlpha, WithLineWidth;
  private $polygon;
  private $fillColor;
  private $fillAlpha;

  public function __construct(array $options = DEFAULT_MAP_POLYGON_OPTIONS)
  {
    parent::__construct(ElementType::MAP_POLYGON);

    $this->setPolygon($polygon);

    $this->initDescription($options);
    $this->initLink($options);
    $this->initTitle($options);
    $this->initLineColor($options);
    $this->initLineAlpha($options);
    $this->initLineWidth($options);

    if (isset($options['fillColor'])) {
      $this->setFillColor($options['fillAlpha']);
    }
    if (isset($options['fillAlpha'])) {
      $this->setFillAlpha($options['fillAlpha']);
    }
  }

  public function setPolygon(array $polygon)
  {
    foreach ($polygon as $point) {
      $this->addPolygonPoint($point);
    }
  }

  public function addPolygonPoint(Point $point)
  {
    if (!$this->polygon) {
      $this->polygon = [];
    }
    array_push($this->polygon, $point);
  }

  public function setFillColor(string $fillColor)
  {
    $this->fillColor = $fillColor;
  }

  public function setFillAlpha(float $fillAlpha)
  {
    $this->fillAlpha = $fillAlpha;
  }

  public function render()
  {
    $render = parent::render();
    $render['polygon'] = Functions::safeRender($this->polygon);

    $this->renderDescription($render);
    $this->renderLink($render);
    $this->renderTitle($render);
    $this->renderLineColor($render);
    $this->renderLineAlpha($render);
    $this->renderLineWidth($render);

    if (isset($this->fillColor)) {
      $render['fillColor'] = $this->fillColor;
    }
    if (isset($this->fillAlpha)) {
      $render['fillAlpha'] = $this->fillAlpha;
    }

    return $render;
  }
}
