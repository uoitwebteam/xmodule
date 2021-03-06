<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithContent;
use \XModule\Traits\WithId;
use \XModule\Traits\WithSubtitle;
use \XModule\Traits\WithThumbnail;
use \XModule\Traits\WithTitle;

const DEFAULT_DETAIL_OPTIONS = [
  'id' => null,
  'title' => null,
  'subtitle' => null,
  'body' => null,
  'content' => [],
  'thumbnail' => null,
];

class Detail extends Element
{
  use WithId, WithSubtitle, WithThumbnail, WithTitle, WithContent;
  private $body;

  public function __construct(array $options = DEFAULT_DETAIL_OPTIONS)
  {
    parent::__construct(ElementType::DETAIL);

    self::initId($options);
    self::initTitle($options);
    self::initContent($options);
    self::initThumbnail($options);
    self::initSubtitle($options);

    if (isset($options['body'])) {
      $this->setBody($options['body']);
    }
  }

  public function setBody(string $body)
  {
    $this->body = $body;
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);
    self::renderTitle($render);
    self::renderContent($render);
    self::renderThumbnail($render);
    self::renderSubtitle($render);

    if (isset($this->body)) {
      $render['body'] = $this->body;
    }

    return $render;
  }
}
