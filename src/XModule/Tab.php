<?php

namespace XModule;

use \XModule\Traits\WithAjaxContent;
use \XModule\Traits\WithTitle;

const DEFAULT_TAB_OPTIONS = [
  'title' => null,
  'content' => [],
];

class Tab
{
  use WithTitle, WithAjaxContent;

  public function __construct(array $options = DEFAULT_TAB_OPTIONS)
  {
    self::initTitle($options);
    self::initContent($options);
  }

  public function render()
  {
    $render = [];

    self::renderTitle($render);
    self::renderContent($render);

    return $render;
  }
}
