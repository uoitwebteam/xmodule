<?php

namespace XModule;

use \XModule\GridItemImage;
use \XModule\Shared\Functions;
use \XModule\Traits\WithLabel;
use \XModule\Traits\WithLink;

class GridItem
{
  use WithLabel, WithLink;
  private $image;

  public function __construct($label, $link, $image)
  {
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
    $render = [];

    self::renderLabel($render);
    self::renderLink($render);

    if (isset($this->image)) {
      $render['image'] = Functions::safeRender($this->image);
    }

    return $render;
  }
}
