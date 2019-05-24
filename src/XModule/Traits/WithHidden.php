<?php
namespace XModule\Traits;

trait WithHidden
{
  private $hidden;

  public function initHidden(array $options)
  {
    if (isset($options['hidden'])) {
      $this->setHidden($options['hidden']);
    }
  }

  public function setHidden(bool $hidden)
  {
    $this->hidden = $hidden;
  }

  public function renderHidden(&$render)
  {
    if (isset($this->hidden)) {
      $render['hidden'] = $this->hidden;
    }
  }
}
