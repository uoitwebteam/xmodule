<?php
namespace XModule\Traits;

trait WithLineAlpha
{
  private $lineAlpha;

  public function initLineAlpha(array $options)
  {
    if (isset($options['lineAlpha'])) {
      $this->setLineAlpha($options['lineAlpha']);
    }
  }

  public function setLineAlpha(float $lineAlpha)
  {
    $this->lineAlpha = $lineAlpha;
  }

  public function renderLineAlpha(&$render)
  {
    if (isset($this->lineAlpha)) {
      $render['lineAlpha'] = $this->lineAlpha;
    }
  }
}
