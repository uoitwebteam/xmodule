<?php

namespace XModule;

use \XModule\Constants\ElementType;
use \XModule\Base\Element;

const DEFAULT_<%= constant %>_OPTIONS = [];

class <%= classname %> extends Element {

  public function __construct(array $options = DEFAULT_<%= constant %>_OPTIONS) {
    parent::__construct(ElementType::<%= constant %>);
  }

  public function render() {
    $render = parent::render();
    return $render;
  }
}
