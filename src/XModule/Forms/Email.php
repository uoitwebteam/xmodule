<?php
namespace XModule\Forms;

use \XModule\Base\FormControl;
use \XModule\Constants\InputType;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithPlaceholder;
use \XModule\Traits\WithRequired;
use \XModule\Traits\WithValue;

const DEFAULT_EMAIL_OPTIONS = [
  'description' => null,
  'value' => null,
  'placeholder' => null,
  'required' => false,
];

class Email extends FormControl
{
  use WithDescription, WithRequired, WithValue, WithPlaceholder;

  public function __construct(string $label, string $name, array $options = DEFAULT_EMAIL_OPTIONS)
  {
    parent::__construct(InputType::EMAIL, $label, $name);

    self::initDescription($options);
    self::initRequired($options);
    self::initValue($options);
    self::initPlaceholder($options);
  }

  public function render()
  {
    $render = parent::render();

    self::renderDescription($render);
    self::renderRequired($render);
    self::renderValue($render);
    self::renderPlaceholder($render);

    return $render;
  }
}
