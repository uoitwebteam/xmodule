<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Shared\Functions;
use \XModule\ToolbarMenuItem;

class ToolbarMenu extends Element
{
  private $items;

  public function __construct(array $items)
  {
    parent::__construct(ElementType::TOOLBAR_MENU);

    $this->setItems($items);
  }

  public function setItems(array $items)
  {
    $this->items = [];
    foreach ($items as $item) {
      $this->addItem($item);
    }
  }

  public function addItem(ToolbarMenuItem $item)
  {
    array_push($this->items, $item);
  }

  public function render()
  {
    $render = parent::render();
    $render['items'] = Functions::safeRender($this->items);
    return $render;
  }
}
