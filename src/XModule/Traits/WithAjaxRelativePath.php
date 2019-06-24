<?php
namespace XModule\Traits;

trait WithAjaxRelativePath
{
  private $ajaxRelativePath;

  public function initAjaxRelativePath(array $options)
  {
    if (isset($options['ajaxRelativePath'])) {
      $this->setAjaxRelativePath($options['ajaxRelativePath']);
    }
  }

  public function setAjaxRelativePath(string $ajaxRelativePath)
  {
    $this->ajaxRelativePath = $ajaxRelativePath;
  }

  public function renderAjaxRelativePath(&$render)
  {
    if (isset($this->ajaxRelativePath)) {
      $render['ajaxRelativePath'] = $this->ajaxRelativePath;
    }
  }
}
