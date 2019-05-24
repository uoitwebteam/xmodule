<?php
namespace XModule\Traits;

trait WithPlaceholder
{
  private $placeholder;

  public function initPlaceholder(array $options)
  {
    if (isset($options['placeholder'])) {
      $this->setPlaceholder($options['placeholder']);
    }
  }

  public function setPlaceholder(string $placeholder)
  {
    $this->placeholder = $placeholder;
  }

  public function renderPlaceholder(&$render)
  {
    if (isset($this->placeholder)) {
      $render['placeholder'] = $this->placeholder;
    }
  }
}
