<?php
namespace XModule\Traits;

trait WithLineWidth
{
  private $lineWidth;

  public function initLineWidth(array $options)
  {
    if (isset($options['lineWidth'])) {
      $this->setLineWidth($options['lineWidth']);
    }
  }

  public function setLineWidth(int $lineWidth)
  {
    $this->lineWidth = $lineWidth;
  }

  public function renderLineWidth(&$render)
  {
    if (isset($this->lineWidth)) {
      $render['lineWidth'] = $this->lineWidth;
    }
  }
}
