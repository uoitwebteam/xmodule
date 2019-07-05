<?php
namespace XModule\Traits;

use \XModule\Shared\Foreground;

trait WithForeground
{
  private $foreground;

  public function initForeground(array $options)
  {
    if (isset($options['foreground'])) {
      $this->setForeground($options['foreground']);
    }
  }

  public function setForeground(Foreground $foreground)
  {
    $this->foreground = $foreground;
  }

  public function renderForeground(&$render)
  {
    if (isset($this->foreground)) {
      $render['foreground'] = $this->foreground;
    }
  }
}
