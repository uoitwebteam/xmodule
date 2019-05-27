<?php

namespace XModule\Maps;

class Size
{
  private $height;
  private $width;

  public function __construct(int $height, int $width)
  {
    $this->setHeight($height);
    $this->setWidth($width);
  }

  public function setHeight(int $height)
  {
    $this->height = $height;
  }

  public function setWidth(int $width)
  {
    $this->width = $width;
  }

  public function render()
  {
    $render = [
      'height' => $this->height,
      'width' => $this->width,
    ];
    return $render;
  }
}
