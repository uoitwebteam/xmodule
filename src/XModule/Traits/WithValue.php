<?php
namespace XModule\Traits;

trait WithValue
{
  private $value;

  public function initValue(array $options)
  {
    if (isset($options['value'])) {
      $this->setValue($options['value']);
    }
  }

  public function setValue(string $value)
  {
    $this->value = $value;
  }

  public function renderValue(&$render)
  {
    if (isset($this->value)) {
      $render['value'] = $this->value;
    }
  }
}
