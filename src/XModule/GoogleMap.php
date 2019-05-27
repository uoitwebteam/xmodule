<?php

namespace XModule;

use \XModule\Constants\ElementType;
use \XModule\Base\Element;

const DEFAULT_GOOGLE_MAP_OPTIONS = [];

class GoogleMap extends Element {

  public function __construct(array $options = DEFAULT_GOOGLE_MAP_OPTIONS) {
    parent::__construct(ElementType::GOOGLE_MAP);
  }

  public function render() {
    $render = parent::render();
    return $render;
  }
}
