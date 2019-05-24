<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithHidden;
use \XModule\Traits\WithId;
use \XModule\Traits\WithLabel;

const DEFAULT_LOADING_INDICATOR_OPTIONS = [
  'id' => null,
  'label' => null,
  'hidden' => false,
];

class LoadingIndicator extends Element
{
  use WithId, WithLabel, WithHidden;

  public function __construct(array $options = DEFAULT_LOADING_INDICATOR_OPTIONS)
  {
    parent::__construct(ElementType::LOADING_INDICATOR);

    self::initId($options);
    self::initLabel($options);
    self::initHidden($options);
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);
    self::renderLabel($render);
    self::renderHidden($render);

    return $render;
  }
}
