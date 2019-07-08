<?php

namespace XModule\Shared;

use \XModule\Constants\BannerType;
use \XModule\Traits\WithLink;

const DEFAULT_BANNER_OPTIONS = [
  'message' => null,
  'type' => BannerType::INFO,
  'link' => null,
];

class Banner
{
  use WithLink;

  public function __construct(array $options = DEFAULT_BANNER_OPTIONS)
  {
    self::initLink($options);

    if (isset($options['message'])) {
      $this->setMessage($options['message']);
    }
    if (isset($options['type'])) {
      $this->setType($options['type']);
    }
  }

  public function setMessage(string $message)
  {
    $this->message = $message;
  }

  public function setType(string $type)
  {
    $this->type = BannerType::validate($type, 'type');
  }

  public function render()
  {
    $render = [];

    self::renderLink($render);

    if (isset($this->message)) {
      $render['message'] = $this->message;
    }
    if (isset($this->type)) {
      $render['type'] = Functions::safeRender($this->type);
    }

    return $render;
  }
}
