<?php
namespace XModule\Traits;

use \XModule\Shared\Functions;
use \XModule\Shared\Image;

trait WithBackground
{
  private $background;

  public function initBackground(array $options)
  {
    if (isset($options['background'])) {
      $this->setBackground($options['background']);
    }
  }

  public function setBackground(Image $background)
  {
    $this->background = $background;
  }

  public function renderBackground(&$render)
  {
    if (isset($this->background)) {
      $render['background'] = Functions::safeRender($this->background);
    }
  }
}
