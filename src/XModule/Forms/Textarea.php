<?php
namespace XModule\Forms;

use \XModule\Base\FormControl;
use \XModule\Constants\InputType;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithRequired;
use \XModule\Traits\WithValue;

const DEFAULT_TEXTAREA_OPTIONS = [
  'description' => null,
  'value' => null,
  'required' => false,
];

class Textarea extends FormControl
{
  use WithDescription, WithRequired, WithValue;

  public function __construct(string $label, string $name, array $options = DEFAULT_TEXTAREA_OPTIONS)
  {
    parent::__construct(InputType::TEXTAREA, $label, $name);

    self::initDescription($options);
    self::initRequired($options);
    self::initValue($options);
  }

  public function render()
  {
    $render = parent::render();

    self::renderDescription($render);
    self::renderRequired($render);
    self::renderValue($render);

    return $render;
  }
}
