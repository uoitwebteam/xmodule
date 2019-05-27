<?php

namespace XModule;

use \XModule\Constants\ElementType;
use \XModule\Base\Element;

const DEFAULT_MAP_POLYGON_OPTIONS = [];

class MapPolygon extends Element {

  public function __construct(array $options = DEFAULT_MAP_POLYGON_OPTIONS) {
    parent::__construct(ElementType::MAP_POLYGON);
  }

  public function render() {
    $render = parent::render();
    return $render;
  }
}
