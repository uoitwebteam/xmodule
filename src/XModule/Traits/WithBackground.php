<?php
namespace XModule\Traits;

trait WithBackground
{
  private $background;

  public function initBackground(array $options)
  {
    if (isset($options['background'])) {
      $this->setBackground($options['background']);
    }
  }

  public function setBackground(array $background)
  {
    if (isset($background['url'])) {
      $this->background = $background;
    } else {
      Functions::throwInvalidType($background, $this->getElementType(), 'background');
    }
  }

  public function renderBackground(&$render)
  {
    if (isset($this->background)) {
      $render['background'] = $this->background;
    }
  }
}
