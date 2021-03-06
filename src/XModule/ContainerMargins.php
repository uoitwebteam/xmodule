<?php

namespace XModule;

use \XModule\Constants\Margins;
use \XModule\Traits\WithValue;

const DEFAULT_CONTAINER_MARGINS_OPTIONS = [
  'value' => Margins::NONE,
];

class ContainerMargins
{
  use WithValue;

  public function __construct(array $options = DEFAULT_CONTAINER_MARGINS_OPTIONS)
  {
    self::initValue($options);
  }

  public function setValue(string $value)
  {
    $this->value = Margins::validate($value, 'containerMargins');
  }

  public function render()
  {
    $render = [];

    self::renderValue($render);

    return $render;
  }
}
