<?php

namespace XModule\XComponent;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\LayoutType;
use \XModule\Constants\ModuleType;
use \XModule\Traits\WithLink;
use \XModule\Traits\WithSubtitle;

const DEFAULT_CONTENT_CARD_OPTIONS = [
  'image' => null,
  'title' => null,
  'subtitle' => null,
  'link' => null,
];

class ContentTile extends Element
{
  use WithSubtitle, WithTitle, WithLink;
  public $image;

  public function __construct(array $options = DEFAULT_CONTENT_CARD_OPTIONS)
  {
    parent::__construct([ModuleType::PUBLISH, LayoutType::CARDNAV, ElementType::CONTENT_CARD]);

    self::initLink($options);
    self::initTitle($options);
    self::initSubtitle($options);

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

    self::renderLink($render);
    self::renderTitle($render);
    self::renderSubtitle($render);

    if (isset($this->image)) {
      $render['image'] = $this->image;
    }

    return $render;
  }
}
