<?php
namespace XModule\Traits;

trait WithForeground
{
  private $foreground;

  public function initForeground(array $options)
  {
    if (isset($options['foreground'])) {
      $this->setForeground($options['foreground']);
    }
  }

  public function setForeground(array $foreground)
  {
    if (isset($foreground['url'])) {
      $this->foreground = $foreground;
    } else {
      Functions::throwInvalidType($foreground, $this->getElementType(), 'foreground');
    }
  }

  public function renderForeground(&$render)
  {
    if (isset($this->foreground)) {
      $render['foreground'] = $this->foreground;
    }
  }
}
