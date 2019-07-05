<?php
namespace XModule\Traits;

use \XModule\Shared\Background;

trait WithBackground
{
  private $background;

  public function initBackground(array $options)
  {
    if (isset($options['background'])) {
      $this->setBackground($options['background']);
    }
  }

  public function setBackground(Background $background)
  {
    $this->background = $background;
  }

  public function renderBackground(&$render)
  {
    if (isset($this->background)) {
      $render['background'] = $this->background;
    }
  }
}
