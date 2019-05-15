<?php

namespace XModule\Shared;

use \XModule\Constants\Size;

const DEFAULT_BADGE_OPTIONS = [
  'size' => Size::SMALL,
];

class Badge
{
  private $value;
  private $descriptor;
  private $size;

  public function __construct($value, $descriptor, $options = DEFAULT_BADGE_OPTIONS)
  {
    $this->setValue($value);
    $this->setDescriptor($descriptor);

    if ($options['size']) {
      $this->setSize($options['size']);
    }
  }

  public function setValue(string $value)
  {
    $this->value = $value;
  }

  public function setDescriptor(string $descriptor)
  {
    $this->descriptor = $descriptor;
  }

  public function setSize(string $size)
  {
    $this->size = Size::validate($size, 'badge', 'size');
  }

  public function render()
  {
    $render = [
      'value' => $this->value,
      'descriptor' => $this->descriptor,
    ];

    if (isset($this->size)) {
      $render['size'] = $this->size;
    }

    return $render;
  }
}
