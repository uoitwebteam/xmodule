<?php

namespace XModule\Base;

use \XModule\Constants\ElementType;
use \XModule\Constants\InputType;

class FormElement extends Element
{
  private $inputType;
  private $label;

  public function __construct(string $inputType, string $label)
  {
    parent::__construct(ElementType::INPUT);

    $this->setInputType($inputType);
    $this->setLabel($label);
  }

  public function setLabel(string $label)
  {
    $this->label = $label;
  }

  private function setInputType($type)
  {
    $this->inputType = InputType::validate($type, $this->getElementType());
  }

  public function render()
  {
    $render = parent::render();

    $render['inputType'] = $this->inputType;
    $render['label'] = $this->label;

    return $render;
  }
}
