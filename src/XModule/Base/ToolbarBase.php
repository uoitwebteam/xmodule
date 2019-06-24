<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\Position;
use \XModule\Shared\Functions;
use \XModule\ToolbarButton;
use \XModule\ToolbarLabel;
use \XModule\ToolbarMenu;
use \XModule\Traits\WithId;

const DEFAULT_TOOLBAR_OPTIONS = [
  'id' => null,
  Position::LEFT => [],
  Position::RIGHT => [],
  Position::MIDDLE => [],
];

class ToolbarBase extends Element
{
  use WithId;
  private $left;
  private $middle;
  private $right;

  public function __construct(string $type = ElementType::TOOLBAR, array $options = DEFAULT_TOOLBAR_OPTIONS)
  {
    parent::__construct(ElementType::validate($type), 'toolbar base');

    self::initId($options);

    $positions = [Position::LEFT, Position::MIDDLE, Position::RIGHT];
    foreach ($positions as $position) {
      if ($options[$position]) {
        $this->setItems($position, $options[$position]);
      }
    }
  }

  public function setLeftItems(array $items)
  {
    $this->setItems(Position::LEFT, $items);
  }

  public function setMiddleItems(array $items)
  {
    $this->setItems(Position::MIDDLE, $items);
  }

  public function setRightItems(array $items)
  {
    $this->setItems(Position::RIGHT, $items);
  }

  public function setItems(string $position, array $items)
  {
    $position = Position::validate($position, $this->getElementType());
    $this->$position = [];
    foreach ($items as $item) {
      $this->addItem($position, $item);
    }
  }

  public function addLeftItem($item)
  {
    $this->addItem(Position::LEFT, $item);
  }

  public function addMiddleItem($item)
  {
    $this->addItem(Position::MIDDLE, $item);
  }

  public function addRightItem($item)
  {
    $this->addItem(Position::RIGHT, $item);
  }

  public function addItem(string $position, $item)
  {
    if (Functions::isOneOf($item, [ToolbarButton::class, ToolbarLabel::class, ToolbarMenu::class])) {
      array_push($this->$position, $item);
    } else {
      Functions::throwInvalidType($item, $this->getElementType());
    }
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);

    if (isset($this->left)) {
      $render[Position::LEFT] = Functions::safeRender($this->left);
    }
    if (isset($this->right)) {
      $render[Position::RIGHT] = Functions::safeRender($this->right);
    }
    if (isset($this->middle)) {
      $render[Position::MIDDLE] = Functions::safeRender($this->middle);
    }

    return $render;
  }
}
