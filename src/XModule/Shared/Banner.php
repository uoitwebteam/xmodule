<?php

namespace XModule\Shared;

use \XModule\Constants\BannerType;

const DEFAULT_BANNER_OPTIONS = [
  'message' => null,
  'type' => BannerType::INFO,
  'link' => null,
];

class Banner
{

  public function __construct(array $options = DEFAULT_BANNER_OPTIONS)
  {
  }

  public function render()
  {
    $render = [];
    return $render;
  }
}
