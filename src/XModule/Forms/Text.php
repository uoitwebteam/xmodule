<?php

namespace XModule\Forms;

use \XModule\Base\FormControl;
use \XModule\Constants\InputType;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithRequired;
use \XModule\Traits\WithValue;

const DEFAULT_TEXT_OPTIONS = [
  'description' => null,
  'value' => null,
  'placeholder' => null,
  'required' => false,
];

class Text extends FormControl
{
  use WithDescription, WithRequired, WithValue;
  private $placeholder;

  public function __construct(string $label, string $name, array $options = DEFAULT_TEXT_OPTIONS)
  {
    parent::__construct(InputType::TEXT, $label, $name);

    self::initDescription($options);
    self::initRequired($options);
    self::initValue($options);

    if (isset($options['placeholder'])) {
      $this->setPlaceholder($options['placeholder']);
    }
  }

  public function setPlaceholder(string $placeholder)
  {
    $this->placeholder = $placeholder;
  }

  public function render()
  {
    $render = parent::render();

    self::renderDescription($render);
    self::renderRequired($render);
    self::renderValue($render);

    if (isset($this->placeholder)) {
      $render['placeholder'] = $this->placeholder;
    }

    return $render;
  }
}
