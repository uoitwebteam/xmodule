<?php

namespace XModule\Shared;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithAjaxRelativePath;
use \XModule\Traits\WithAjaxUpdateInterval;

const DEFAULT_AJAX_CONTENT_OPTIONS = [
  'ajaxUpdateInterval' => null,
  'ajaxOnFirstLoad' => false,
];

class AjaxContent extends Element
{
  use WithAjaxRelativePath, WithAjaxUpdateInterval;
  private $ajaxOnFirstLoad;

  public function __construct($ajaxRelativePath, $options = DEFAULT_AJAX_CONTENT_OPTIONS)
  {
    parent::__construct(ElementType::AJAX_CONTENT);

    self::initAjaxRelativePath(['ajaxRelativePath' => $ajaxRelativePath]);
    self::initAjaxUpdateInterval($options);

    if (isset($options['ajaxOnFirstLoad'])) {
      $this->setAjaxOnFirstLoad($options['ajaxOnFirstLoad']);
    }
  }

  public function setAjaxOnFirstLoad(bool $ajaxOnFirstLoad)
  {
    $this->ajaxOnFirstLoad = $ajaxOnFirstLoad;
  }

  public function render()
  {
    $render = parent::render();

    self::renderAjaxRelativePath($render);
    self::renderAjaxUpdateInterval($render);

    if (isset($this->ajaxOnFirstLoad)) {
      $render['ajaxOnFirstLoad'] = $this->ajaxOnFirstLoad;
    }

    return $render;
  }
}
