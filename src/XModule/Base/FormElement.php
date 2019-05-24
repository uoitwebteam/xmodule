<?php

namespace XModule\Base;

use \XModule\Constants\ElementType;
use \XModule\Constants\InputType;

class FormElement extends Element
{
  private $inputType;

  public function __construct(string $inputType)
  {
    parent::__construct(ElementType::INPUT);

    $this->setInputType($inputType);
  }

  private function setInputType($type)
  {
    $this->inputType = InputType::validate($type, $this->getElementType());
  }

  public function render()
  {
    $render = parent::render();

    $render['inputType'] = $this->inputType;

    return $render;
  }
}
