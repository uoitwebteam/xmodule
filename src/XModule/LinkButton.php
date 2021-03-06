<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\AccessoryIconPosition;
use \XModule\Constants\ActionType;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithAccessoryIconPosition;
use \XModule\Traits\WithId;
use \XModule\Traits\WithLink;

const DEFAULT_LINK_BUTTON_OPTIONS = [
  'id' => null,
  'link' => null,
  'disabled' => false,
  'accessoryIconPosition' => AccessoryIconPosition::LEFT,
  'actionType' => null,
];

class LinkButton extends Element
{
  use WithAccessoryIconPosition, WithId, WithLink;
  private $title;
  private $disabled;
  private $actionType;

  public function __construct(string $title, array $options = DEFAULT_LINK_BUTTON_OPTIONS)
  {
    parent::__construct(ElementType::LINK_BUTTON);

    $this->setTitle($title);

    self::initId($options);
    self::initLink($options);
    self::initAccessoryIconPosition($options);

    if (isset($options['disabled'])) {
      $this->setDisabled($options['disabled']);
    }
    if (isset($options['actionType'])) {
      $this->setActionType($options['actionType']);
    }
  }

  public function setTitle(string $title)
  {
    $this->title = $title;
  }

  public function setDisabled(bool $disabled)
  {
    $this->disabled = $disabled;
  }

  public function setActionType(string $actionType)
  {
    $this->actionType = ActionType::validate($actionType, $this->getElementType());
  }

  public function render()
  {
    $render = parent::render();
    $render['title'] = $this->title;

    self::renderId($render);
    self::renderLink($render);
    self::renderAccessoryIconPosition($render);

    if (isset($this->disabled)) {
      $render['disabled'] = $this->disabled;
    }
    if (isset($this->actionType)) {
      $render['actionType'] = $this->actionType;
    }

    return $render;
  }
}
