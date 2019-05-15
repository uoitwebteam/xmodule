<?php

namespace XModule;

use \XModule\Traits\WithLink;
use \XModule\Traits\WithSubtitle;
use \XModule\Traits\WithThumbnail;
use \XModule\Traits\WithTitle;

const DEFAULT_TABLE_CELL_OPTIONS = [
  'title' => null,
  'subtitle' => null,
  'link' => null,
];

class TableCell
{
  use WithSubtitle, WithTitle, WithThumbnail, WithLink;

  public function __construct(array $options = DEFAULT_TABLE_CELL_OPTIONS)
  {
    self::initTitle($options);
    self::initLink($options);
    self::initSubtitle($options);
    self::initThumbnail($options);
  }

  public function render()
  {
    $render = [];

    self::renderTitle($render);
    self::renderLink($render);
    self::renderSubtitle($render);
    self::renderThumbnail($render);

    return $render;
  }
}
