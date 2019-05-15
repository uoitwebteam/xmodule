<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Image;
use \XModule\Traits\WithLabel;
use \XModule\Traits\WithLink;

const DEFAULT_GRID_ITEM_OPTIONS = [
  'image' => null,
  'label' => null,
  'link' => null,
];

class GridItem extends Element
{
  use WithLabel, WithLink;
  private $image;

  public function __construct(array $options = DEFAULT_GRID_ITEM_OPTIONS)
  {
    parent::__construct(ElementType::GRID_ITEM);

    self::initLabel($options);
    self::initLink($options);

    if (isset($options['image'])) {
      $this->setImage($options['image']);
    }
  }

  public function setImage(Image $image)
  {
    $this->image = $image;
  }

  public function render()
  {
    $render = parent::render();

    self::renderLabel($render);
    self::renderLink($render);

    if (isset($this->image)) {
      $render['image'] = Functions::safeRender($this->image);
    }

    return $render;
  }
}
