<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\CarouselItemImage;
use \XModule\Constants\ElementType;
use \XModule\Shared\Functions;
use \XModule\Traits\WithLink;
use \XModule\Traits\WithSubtitle;
use \XModule\Traits\WithTitle;

const DEFAULT_CAROUSEL_ITEM_OPTIONS = [
  'title' => null,
  'subtitle' => null,
  'link' => null,
  'image' => null,
];

class CarouselItem extends Element
{
  use WithSubtitle, WithTitle, WithLink;
  private $image;

  public function __construct(array $options = DEFAULT_CAROUSEL_ITEM_OPTIONS)
  {
    parent::__construct(ElementType::CAROUSEL_ITEM);

    self::initLink($options);
    self::initTitle($options);
    self::initSubtitle($options);

    if (isset($options['image'])) {
      $this->setImage($image);
    }
  }

  public function setImage(CarouselItemImage $image)
  {
    $this->image = $image;
  }

  public function render()
  {
    $render = parent::render();

    self::renderLink($render);
    self::renderTitle($render);
    self::renderSubtitle($render);

    if (isset($this->image)) {
      $render['image'] = Functions::safeRender($this->image);
    }

    return $render;
  }
}
