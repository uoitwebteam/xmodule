<?php
namespace XModule\Traits;

trait WithLineColor
{
  private $lineColor;

  public function initLineColor(array $options)
  {
    if (isset($options['lineColor'])) {
      $this->setLineColor($options['lineColor']);
    }
  }

  public function setLineColor(string $lineColor)
  {
    $this->lineColor = $lineColor;
  }

  public function renderLineColor(&$render)
  {
    if (isset($this->lineColor)) {
      $render['lineColor'] = $this->lineColor;
    }
  }
}
