<?php

namespace XModule;

use \XModule\Base\ToolbarBase;
use \XModule\Constants\ElementType;
use \XModule\Constants\Position;

const DEFAULT_TOOLBAR_CONTENT_OPTIONS = [
  'id' => null,
  Position::LEFT => [],
  Position::RIGHT => [],
  Position::MIDDLE => [],
];

class ToolbarContent extends ToolbarBase
{
  public function __construct(array $options = DEFAULT_TOOLBAR_CONTENT_OPTIONS)
  {
    parent::__construct(ElementType::TOOLBAR_CONTENT, $options);
  }
}
