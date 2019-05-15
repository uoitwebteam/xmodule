<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ActionType;
use \XModule\Constants\ElementType;
use \XModule\Constants\Position;
use \XModule\Traits\WithAccessoryIconPosition;
use \XModule\Traits\WithLink;

const DEFAULT_TOOLBAR_BUTTON_OPTIONS = [
  'link' => null,
  'accessoryIconPosition' => Position::LEFT,
  'actionType' => null,
];

class ToolbarButton extends Element
{
  use WithAccessoryIconPosition, WithLink;
  private $title;
  private $actionType;

  public function __construct(string $title, array $options = DEFAULT_TOOLBAR_BUTTON_OPTIONS)
  {
    parent::__construct(ElementType::TOOLBAR_BUTTON);

    $this->setTitle($title);

    self::initLink($options);
    self::initAccessoryIconPosition($options);

    if (isset($options['actionType'])) {
      $this->setActionType($options['actionType']);
    }
  }

  public function setTitle(string $title)
  {
    $this->title = $title;
  }

  public function setActionType(string $actionType)
  {
    $this->actionType = ActionType::validate($actionType, $this->getElementType());
  }

  public function render()
  {
    $render = parent::render();
    $render['title'] = $this->title;

    self::renderLink($render);
    self::renderAccessoryIconPosition($render);

    if (isset($this->actionType)) {
      $render['actionType'] = $this->actionType;
    }

    return $render;
  }
}
