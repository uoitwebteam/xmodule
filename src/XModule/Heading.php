<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithId;

const DEFAULT_HEADING_OPTIONS = [
  'id' => null,
  'description' => null,
  'inset' => true,
];

class Heading extends Element
{
  use WithId, WithDescription;
  private $inset;

  public function __construct(string $title, array $options = DEFAULT_HEADING_OPTIONS)
  {
    parent::__construct(ElementType::HEADING);

    $this->setTitle($title);

    self::initId($options);
    self::initDescription($options);

    if (isset($options['inset'])) {
      $this->setInset($options['inset']);
    }
  }

  public function setTitle(string $title)
  {
    $this->title = $title;
  }

  public function setInset(bool $inset)
  {
    $this->inset = $inset;
  }

  public function render()
  {
    $render = parent::render();
    $render['title'] = $this->title;

    self::renderId($render);
    self::renderDescription($render);

    if (isset($this->inset)) {
      $render['inset'] = $this->inset;
    }

    return $render;
  }
}
