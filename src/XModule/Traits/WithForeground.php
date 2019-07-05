<?php
namespace XModule\Traits;

use \XModule\Shared\Functions;
use \XModule\Shared\Image;

trait WithForeground
{
  private $foreground;

  public function initForeground(array $options)
  {
    if (isset($options['foreground'])) {
      $this->setForeground($options['foreground']);
    }
  }

  public function setForeground(Image $foreground)
  {
    $this->foreground = $foreground;
  }

  public function renderForeground(&$render)
  {
    if (isset($this->foreground)) {
      $render['foreground'] = Functions::safeRender($this->foreground);
    }
  }
}
