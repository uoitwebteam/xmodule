<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\GridItemImage;
use \XModule\Shared\Functions;
use \XModule\Traits\WithLabel;
use \XModule\Traits\WithLink;

class GridItem extends Element
{
  use WithLabel, WithLink;
  private $image;

  public function __construct($label, $link, $image)
  {
    parent::__construct(ElementType::GRID_ITEM);

    self::initLabel(['label' => $label]);
    self::initLink(['link' => $link]);

    $this->setImage($image);
  }

  public function setImage(GridItemImage $image)
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
