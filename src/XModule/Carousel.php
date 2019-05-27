<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\CarouselItem;
use \XModule\Constants\ElementType;
use \XModule\Shared\Functions;
use \XModule\Traits\WithId;

const DEFAULT_CAROUSEL_OPTIONS = [
  'id' => null,
  'items' => null,
];

class Carousel extends Element
{
  use WithId;

  public function __construct(array $options = DEFAULT_CAROUSEL_OPTIONS)
  {
    parent::__construct(ElementType::CAROUSEL);

    self::initId($options);

    if (isset($options['items'])) {
      $this->setItems($options['items']);
    }
  }

  public function setItems(array $items)
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

    self::renderId($render);

    if (isset($this->grouped)) {
      $render['items'] = Functions::safeRender($this->items);
    }

    return $render;
  }
}
