<?php
namespace XModule\Traits;

trait WithLabel
{
  private $label;

  public function initLabel(array $options)
  {
    if (isset($options['label'])) {
      $this->setLabel($options['label']);
    }
  }

  public function setLabel(string $label)
  {
    $this->label = $label;
  }

  public function renderLabel(&$render)
  {
    if (isset($this->label)) {
      $render['label'] = $this->label;
    }
  }
}
