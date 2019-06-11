<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\Margins;
use \XModule\ContainerMargins;
use \XModule\Shared\Functions;
use \XModule\Traits\WithAjaxContent;
use \XModule\Traits\WithHidden;
use \XModule\Traits\WithId;

const DEFAULT_CONTAINER_OPTIONS = [
  'id' => null,
  'content' => [],
  'hidden' => false,
  'margins' => null,
];

class Container extends Element
{
  use WithId, WithAjaxContent, WithHidden;
  private $margins;

  public function __construct(array $options = DEFAULT_CONTAINER_OPTIONS)
  {
    parent::__construct(ElementType::CONTAINER);

    self::initId($options);
    self::initContent($options);
    self::initHidden($options);

    if (isset($options['margins'])) {
      $this->setMargins($options['margins']);
    }
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
    self::renderHidden($render);

    if (isset($this->margins)) {
      $render['margins'] = Functions::safeRender($this->margins);
    }

    return $render;
  }
}
