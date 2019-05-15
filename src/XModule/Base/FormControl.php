<?php

namespace XModule\Base;

class FormControl extends FormElement
{
  private $name;

  public function __construct(string $inputType, string $label, string $name)
  {
    parent::__construct($inputType, $label);

    $this->setLabel($label);
    $this->setName($name);
  }

  public function setLabel(string $label)
  {
    $this->label = $label;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function render()
  {
    $render = parent::render();
    
    $render['label'] = $this->label;
    $render['name'] = $this->name;
    
    return $render;
  }
}
