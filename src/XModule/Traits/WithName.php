<?php
namespace XModule\Traits;

trait WithName
{
  private $name;

  public function initName(array $options)
  {
    if (isset($options['name'])) {
      $this->setName($options['name']);
    }
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function renderName(&$render)
  {
    if (isset($this->name)) {
      $render['name'] = $this->name;
    }
  }
}
