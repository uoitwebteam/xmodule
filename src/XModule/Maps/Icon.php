<?php

namespace XModule\Maps;

use \XModule\Shared\Functions;

const DEFAULT_ICON_OPTIONS = [
  'url' => null,
  'scale' => 1.0,
  'size' => null,
  'anchor' => null,
];

class Icon
{
  private $url;
  private $scale;
  private $size;
  private $anchor;

  public function __construct(array $options = DEFAULT_ICON_OPTIONS)
  {
    if (isset($options['url'])) {
      $this->setUrl($options['url']);
    }
    if (isset($options['scale'])) {
      $this->setScale($options['scale']);
    }
    if (isset($options['size'])) {
      $this->setSize($options['size']);
    }
    if (isset($options['anchor'])) {
      $this->setAnchor($options['anchor']);
    }
  }

  public function setUrl(string $url)
  {
    $this->url = $url;
  }

  public function setScale(float $scale)
  {
    $this->scale = $scale;
  }

  public function setSize(Size $size)
  {
    $this->size = $size;
  }

  public function setAnchor(Anchor $anchor)
  {
    $this->anchor = $anchor;
  }

  public function render()
  {
    $render = [];

    if (isset($this->url)) {
      $render['url'] = $this->url;
    }
    if (isset($this->scale)) {
      $render['scale'] = $this->scale;
    }
    if (isset($this->size)) {
      $render['size'] = Functions::safeRender($this->size);
    }
    if (isset($this->anchor)) {
      $render['anchor'] = Functions::safeRender($this->anchor);
    }

    return $render;
  }
}
