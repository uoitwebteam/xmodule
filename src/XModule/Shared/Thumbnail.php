<?php

namespace XModule\Shared;

use \XModule\Traits\WithBadge;
use \XModule\Traits\WithUrl;

const DEFAULT_THUMBNAIL_OPTIONS = [
  'maxWidth' => null,
  'maxHeight' => null,
  'crop' => false,
  'alt' => null,
  'badge' => null,
];

class Thumbnail
{
  use WithUrl, WithBadge;
  private $maxWidth;
  private $maxHeight;
  private $crop;
  private $alt;

  public function __construct(string $url, $options = DEFAULT_THUMBNAIL_OPTIONS)
  {
    self::initUrl(['url' => $url]);
    self::initBadge($options);

    if (isset($options['maxWidth'])) {
      $this->setMaxWidth($options['maxWidth']);
    }
    if (isset($options['maxHeight'])) {
      $this->setMaxHeight($options['maxHeight']);
    }
    if (isset($options['crop'])) {
      $this->setCrop($options['crop']);
    }
    if (isset($options['alt'])) {
      $this->setAlt($options['alt']);
    }
  }

  public function setMaxWidth(int $maxWidth)
  {
    $this->maxWidth = $maxWidth;
  }

  public function setMaxHeight(int $maxHeight)
  {
    $this->maxHeight = $maxHeight;
  }

  public function setCrop(bool $crop)
  {
    $this->crop = $crop;
  }

  public function setAlt(string $alt)
  {
    $this->alt = $alt;
  }

  public function render()
  {
    self::renderUrl($render);
    self::renderBadge($render);

    if (isset($this->maxWidth)) {
      $render['maxWidth'] = $this->maxWidth;
    }
    if (isset($this->maxHeight)) {
      $render['maxHeight'] = $this->maxHeight;
    }
    if (isset($this->crop)) {
      $render['crop'] = $this->crop;
    }
    if (isset($this->alt)) {
      $render['alt'] = $this->alt;
    }

    return $render;
  }
}
