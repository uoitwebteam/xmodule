<?php
namespace XModule\Forms;

use \XModule\Base\FormElement;
use \XModule\Constants\InputType;
use \XModule\Traits\WithName;
use \XModule\Traits\WithValue;

class Hidden extends FormElement
{
  use WithValue, WithName;

  public function __construct($value, $name)
  {
    parent::__construct(InputType::HIDDEN);

    self::initValue(['value' => $value]);
    self::initName(['name' => $name]);
  }

  public function render()
  {
    $render = parent::render();

    self::renderValue($render);
    self::renderName($render);

    return $render;
  }
}
