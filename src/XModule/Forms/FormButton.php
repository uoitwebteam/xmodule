<?php

namespace XModule\Forms;

use \XModule\Base\Element;
use \XModule\Constants\AccessoryIconPosition;
use \XModule\Constants\ActionType;
use \XModule\Constants\ButtonType;
use \XModule\Constants\ElementType;
use \XModule\Constants\Icon;
use \XModule\Traits\WithAccessoryIconPosition;

const DEFAULT_FORM_BUTTON_OPTIONS = [
  'name' => null,
  'buttonType' => ButtonType::SUBMIT,
  'accessoryIcon' => Icon::NONE,
  'accessoryIconPosition' => AccessoryIconPosition::LEFT,
  'actionType' => null,
];

class FormButton extends Element
{
  use WithAccessoryIconPosition;
  private $title;
  private $name;
  private $buttonType;
  private $accessoryIcon;
  private $actionType;

  public function __construct(string $title, array $options = DEFAULT_FORM_BUTTON_OPTIONS)
  {
    parent::__construct(ElementType::FORM_BUTTON);

    $this->setTitle($title);

    self::initAccessoryIconPosition($options);

    if (isset($options['name'])) {
      $this->setName($name);
    }
    if (isset($options['buttonType'])) {
      $this->setButtonType($options['buttonType']);
    }
    if (isset($options['accessoryIcon'])) {
      $this->setAccessoryIcon($options['accessoryIcon']);
    }
    if (isset($options['actionType'])) {
      $this->setActionType($options['actionType']);
    }
  }

  public function setTitle(string $title)
  {
    $this->title = $title;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function setButtonType(string $buttonType)
  {
    $this->buttonType = ButtonType::validate($buttonType, $this->getElementType());
  }

  public function setAccessoryIcon(string $accessoryIcon)
  {
    $this->accessoryIcon = Icon::validate($accessoryIcon, $this->getElementType());
  }

  public function setActionType(string $actionType)
  {
    $this->actionType = ActionType::validate($actionType, $this->getElementType());
  }

  public function render()
  {
    $render = parent::render();
    $render['title'] = $this->title;

    self::renderAccessoryIconPosition($render);

    if (isset($this->name)) {
      $render['name'] = $this->name;
    }
    if (isset($this->buttonType)) {
      $render['buttonType'] = $this->buttonType;
    }
    if (isset($this->accessoryIcon)) {
      $render['accessoryIcon'] = $this->accessoryIcon;
    }
    if (isset($this->actionType)) {
      $render['actionType'] = $this->actionType;
    }

    return $render;
  }
}
