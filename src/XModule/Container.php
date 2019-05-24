<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\Margins;
use \XModule\ContainerMargins;
use \XModule\Traits\WithAjaxContent;
use \XModule\Traits\WithId;

const DEFAULT_CONTAINER_OPTIONS = [
  'id' => null,
  'content' => [],
  'hidden' => false,
  'margins' => null,
];

class Container extends Element
{
  use WithId, WithAjaxContent;
  private $hidden;
  private $margins;

  public function __construct(array $options = DEFAULT_CONTAINER_OPTIONS)
  {
    parent::__construct(ElementType::CONTAINER);

    self::initId($options);
    self::initContent($options);

    if (isset($options['hidden'])) {
      $this->setHidden($options['hidden']);
    }
    if (isset($options['margins'])) {
      $this->setMargins($options['margins']);
    }
  }

  public function setHidden(bool $hidden)
  {
    $this->hidden = $hidden;
  }

  public function setMargins(ContainerMargins $margins)
  {
    $this->margins = $margins;
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);
    self::renderContent($render);

    if (isset($this->hidden)) {
      $render['hidden'] = $this->hidden;
    }
    if (isset($this->margins)) {
      $render['margins'] = $this->margins;
    }

    return $render;
  }
}
