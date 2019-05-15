<?php

namespace XModule\Shared;

use \XModule\Shared\Badge;

const DEFAULT_THUMBNAIL_OPTIONS = [
  'maxWidth' => null,
  'maxHeight' => null,
  'crop' => false,
  'alt' => null,
  'badge' => null,
];

class Thumbnail
{
  private $url;
  private $maxWidth;
  private $maxHeight;
  private $crop;
  private $alt;
  private $badge;

  public function __construct($url, $options = DEFAULT_THUMBNAIL_OPTIONS)
  {
    $this->setUrl($url);

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
    if (isset($options['badge'])) {
      $this->setBadge($options['badge']);
    }
  }

  public function setUrl(string $url)
  {
    $this->url = $url;
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

  public function setBadge(Badge $badge)
  {
    $this->badge = $badge;
  }

  public function render()
  {
    $render = ['url' => $this->url];

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
    if (isset($this->badge)) {
      $render['badge'] = Functions::safeRender($this->badge);
    }

    return $render;
  }
}
