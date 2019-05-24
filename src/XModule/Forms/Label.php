<?php
namespace XModule\Forms;

use \XModule\Constants\InputType;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithLabel;
use \XModule\Traits\WithValue;

const DEFAULT_LABEL_OPTIONS = [
  'description' => null,
  'value' => null,
];

class Label extends FormElement
{
  use WithDescription, WithValue, WithLabel;

  public function __construct(string $label, array $options = DEFAULT_LABEL_OPTIONS)
  {
    parent::__construct(InputType::LABEL);

    self::initLabel(['label' => $label]);
    self::initValue($options);
    self::initDescription($options);
  }

  public function render()
  {
    $render = parent::render();

    self::renderLabel($render);
    self::renderValue($render);
    self::renderDescription($render);

    return $render;
  }
}
