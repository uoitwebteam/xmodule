<?php

namespace XModule;

use \XModule\Constants\ElementType;
use \XModule\Base\Element;

const DEFAULT_MAP_POLYLINE_OPTIONS = [];

class MapPolyline extends Element {

  public function __construct(array $options = DEFAULT_MAP_POLYLINE_OPTIONS) {
    parent::__construct(ElementType::MAP_POLYLINE);
  }

  public function render() {
    $render = parent::render();
    return $render;
  }
}
