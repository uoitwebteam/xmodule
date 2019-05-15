<?php

namespace XModule;

use \XModule\Traits\WithLink;

const DEFAULT_TOOLBAR_MENU_ITEM_OPTIONS = [
  'selected' => false,
  'link' => null,
];

class ToolbarMenuItem
{
  use WithLink;
  private $title;
  private $selected;

  public function __construct(string $title, array $options = DEFAULT_TOOLBAR_MENU_ITEM_OPTIONS)
  {
    $this->setTitle($title);

    self::initLink($options);

    if (isset($options['selected'])) {
      $this->setSelected($options['selected']);
    }
  }

  public function setTitle(string $title)
  {
    $this->title = $title;
  }

  public function setSelected(bool $selected)
  {
    $this->selected = $selected;
  }

  public function render()
  {
    $render = ['title' => $this->title];

    self::renderLink($render);

    if (isset($this->selected)) {
      $render['selected'] = $this->selected;
    }

    return $render;
  }
}
