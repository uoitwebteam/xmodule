<?php

namespace XModule;

use \XModule\Constants\ElementType;
use \XModule\Base\Element;

const DEFAULT_MAP_POINT_OPTIONS = [];

class MapPoint extends Element {

  public function __construct(array $options = DEFAULT_MAP_POINT_OPTIONS) {
    parent::__construct(ElementType::MAP_POINT);
  }

  public function render() {
    $render = parent::render();
    return $render;
  }
}
