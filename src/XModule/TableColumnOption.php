<?php

namespace XModule;

const DEFAULT_TABLE_COLUMN_OPTION_OPTIONS = [
  'header' => null,
  'width' => null,
];

class TableColumnOption
{
  private $header;
  private $width;

  public function __construct(array $options = DEFAULT_TABLE_COLUMN_OPTION_OPTIONS)
  {
    if (isset($options['header'])) {
      $this->setHeader($options['header']);
    }
    if (isset($options['width'])) {
      $this->setWidth($options['width']);
    }
  }

  public function setHeader(string $header)
  {
    $this->header = $header;
  }

  public function setWidth(string $width)
  {
    $this->width = $width;
  }

  public function render()
  {
    $render = [];
    if (isset($this->header)) {
      $render['header'] = $this->header;
    }
    if (isset($this->width)) {
      $render['width'] = $this->width;
    }
    return $render;
  }
}
