<?php
namespace XModule\Traits;

trait WithDescription
{
  private $description;

  public function initDescription(array $options)
  {
    if (isset($options['description'])) {
      $this->setDescription($options['description']);
    }
  }

  public function setDescription(string $description)
  {
    $this->description = $description;
  }

  public function renderDescription(&$render)
  {
    if (isset($this->description)) {
      $render['description'] = $this->description;
    }
  }
}
