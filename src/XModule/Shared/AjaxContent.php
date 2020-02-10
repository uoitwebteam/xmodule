<?php

namespace XModule\Shared;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithAjaxRelativePath;
use \XModule\Traits\WithAjaxUpdateInterval;

const DEFAULT_AJAX_CONTENT_OPTIONS = [
  'ajaxUpdateInterval' => null,
  'ajaxOnFirstLoad' => false,
  'ajaxGeolocationEnabled' => false,
  'ajaxGeolocationContinuous' => false
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
    if (isset($options['setAjaxGeolocationEnabled'])) {
      $this->setAjaxGeolocationEnabled($options['setAjaxGeolocationEnabled']);
    }
    if (isset($options['ajaxGeolocationContinuous'])) {
      $this->setAjaxGeolocationContinuous($options['ajaxGeolocationContinuous']);
    }
  }

  public function setAjaxOnFirstLoad(bool $ajaxOnFirstLoad)
  {
    $this->ajaxOnFirstLoad = $ajaxOnFirstLoad;
  }

  public function setAjaxGeolocationEnabled(bool $ajaxGeolocationEnabled)
  {
    $this->ajaxGeolocationEnabled = $ajaxGeolocationEnabled;
  }

  public function setAjaxGeolocationContinuous(bool $ajaxGeolocationContinuous)
  {
    $this->ajaxGeolocationContinuous = $ajaxGeolocationContinuous;
  }

  public function render()
  {
    $render = parent::render();

    self::renderAjaxRelativePath($render);
    self::renderAjaxUpdateInterval($render);

    if (isset($this->ajaxOnFirstLoad)) {
      $render['ajaxOnFirstLoad'] = $this->ajaxOnFirstLoad;
    }
    if (isset($this->ajaxGeolocationEnabled)) {
      $render['ajaxGeolocationEnabled'] = $this->ajaxGeolocationEnabled;
    }
    if (isset($this->ajaxGeolocationContinuous)) {
      $render['ajaxGeolocationContinuous'] = $this->ajaxGeolocationContinuous;
    }

    return $render;
  }
}
