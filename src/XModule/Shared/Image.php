<?php

namespace XModule\Shared;

use \XModule\Traits\WithUrl;

const DEFAULT_IMAGE_OPTIONS = [
  'alt' => null,
];

class Image
{
  use WithUrl;
  private $alt;

  public function __construct(string $url, array $options = DEFAULT_IMAGE_OPTIONS)
  {
    parent::__construct(ElementType::IMAGE);

    self::initUrl($options);

    if (isset($options['alt'])) {
      $this->setAlt($options['alt']);
    }
  }

  public function setAlt(string $alt)
  {
    $this->alt = $alt;
  }

  public function render()
  {
    $render = [];

    self::renderUrl($render);

    if (isset($this->alt)) {
      $render['alt'] = $this->alt;
    }

    return $render;
  }
}
