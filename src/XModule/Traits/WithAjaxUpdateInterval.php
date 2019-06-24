<?php
namespace XModule\Traits;

trait WithAjaxUpdateInterval
{
  private $ajaxUpdateInterval;

  public function initAjaxUpdateInterval(array $options)
  {
    if (isset($options['ajaxUpdateInterval'])) {
      $this->setAjaxUpdateInterval($options['ajaxUpdateInterval']);
    }
  }

  public function setAjaxUpdateInterval(int $ajaxUpdateInterval)
  {
    $this->ajaxUpdateInterval = $ajaxUpdateInterval;
  }

  public function renderAjaxUpdateInterval(&$render)
  {
    if (isset($this->ajaxUpdateInterval)) {
      $render['ajaxUpdateInterval'] = $this->ajaxUpdateInterval;
    }
  }
}
