<?php
namespace XModule\Base;

use \XModule\Traits\WithLabel;
use \XModule\Traits\WithName;

class FormControl extends FormElement
{
  use WithLabel, WithName;

  public function __construct(string $inputType, string $label, string $name)
  {
    parent::__construct($inputType);

    self::initLabel(['label' => $label]);
    self::initName(['name' => $name]);
  }

  public function render()
  {
    $render = parent::render();

    self::renderLabel($render);
    self::renderName($render);

    return $render;
  }
}
