<?php

namespace XModule;

use \XModule\Base\ToolbarBase;
use \XModule\Constants\ElementType;
use \XModule\Constants\Position;

const DEFAULT_TOOLBAR_OPTIONS = [
  'id' => null,
  Position::LEFT => [],
  Position::RIGHT => [],
  Position::MIDDLE => [],
];

/**
 * Inherits from `\XModule\Base\ToolbarBase` – no methods
 * or properties of its own.
 */
class Toolbar extends ToolbarBase
{
  public function __construct(array $options = DEFAULT_TOOLBAR_OPTIONS)
  {
    parent::__construct(ElementType::TOOLBAR, $options);
  }
}
