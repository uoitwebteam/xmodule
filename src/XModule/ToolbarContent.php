<?php

namespace XModule;

use \XModule\Base\ToolbarBase;
use \XModule\Constants\ElementType;
use \XModule\Constants\Position;
use \XModule\Shared\Functions;
use \XModule\ToolbarMenuItem;

const DEFAULT_TOOLBAR_CONTENT_OPTIONS = [
  'id' => null,
  Position::LEFT => [],
  Position::RIGHT => [],
  Position::MIDDLE => [],
  'menuItems' => null,
  'menuPosition' => Position::LEFT,
  'ajaxUpdateInterval' => null,
];

class ToolbarContent extends ToolbarBase
{
  private $menuItems;
  private $menuPosition;
  private $ajaxUpdateInterval;

  public function __construct(array $options = DEFAULT_TOOLBAR_CONTENT_OPTIONS)
  {
    parent::__construct(ElementType::TOOLBAR_CONTENT, $options);
    if (isset($options['menuItems'])) {
      $this->setMenuItems($options['menuItems']);
    }
    if (isset($options['menuPosition'])) {
      $this->setMenuPosition($options['menuPosition']);
    }
    if (isset($options['ajaxUpdateInterval'])) {
      $this->setAjaxUpdateInterval($options['ajaxUpdateInterval']);
    }

  }

  public function setMenuItems(array $items)
  {
    foreach ($items as $item) {
      $this->addMenuItem($item);
    }
  }

  public function addMenuItem(ToolbarMenuItem $item)
  {
    if (!$this->menuItems) {
      $this->menuItems = [];
    }
    array_push($this->menuItems, $item);
  }

  public function setMenuPosition(string $position)
  {
    $this->menuPosition = Position::validate($position, $this->getElementType());
  }

  public function render()
  {
    $render = parent::render();

    if (isset($this->menuItems)) {
      $render['menuItems'] = Functions::safeRender($this->menuItems);
    }
    if (isset($this->menuPosition)) {
      $render['menuPosition'] = $this->menuPosition;
    }
    if (isset($this->ajaxUpdateInterval)) {
      $render['ajaxUpdateInterval'] = $this->ajaxUpdateInterval;
    }

    return $render;
  }
}
