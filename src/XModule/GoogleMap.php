<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\BaseLayer;
use \XModule\Constants\ElementType;

const DEFAULT_GOOGLE_MAP_OPTIONS = [
  'id' => null,
  'initialLatitude' => 0.0,
  'initialLongitude' => 0.0,
  'initialZoomLevel' => null,
  'disableZoomToPlacemarks' => false,
  'defaultToUserLocated' => false,
  'minZoomLevel' => null,
  'maxZoomLevel' => null,
  'aspectRatio' => '1:1',
  'inset' => false,
  'showUserLocationButton' => true,
  'showRecenterButton' => true,
  'showZoomButtons' => true,
  'baseLayers' => [BaseLayer::ROADMAP],
  'staticPlacemarks' => null,
  'dynamicPlacemarks' => null,
];

class GoogleMap extends Element
{

  public function __construct(array $options = DEFAULT_GOOGLE_MAP_OPTIONS)
  {
    parent::__construct(ElementType::GOOGLE_MAP);
  }

  public function render()
  {
    $render = parent::render();
    return $render;
  }
}
