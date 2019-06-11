<?php

namespace XModule\XComponent;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\LayoutType;
use \XModule\Constants\ModuleType;
use \XModule\Shared\Functions;
use \XModule\XComponent\CarouselItem;

class Carousel extends Element
{
  private $items;

  public function __construct(array $items)
  {
    parent::__construct([ModuleType::PUBLISH, LayoutType::MONDRIAN, ElementType::CAROUSEL]);

    $this->setItems($items);
  }

  public function setItems($items)
  {
    foreach ($items as $item) {
      $this->addItem($item);
    }
  }

  public function addItem(CarouselItem $item)
  {
    if (!$this->items) {
      $this->items = [];
    }
    array_push($this->items, $item);
  }

  public function render()
  {
    $render = parent::render();
    $render['items'] = Functions::safeRender($this->items);

    return $render;
  }
}
