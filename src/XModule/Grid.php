<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\Position;
use \XModule\Constants\Spacing;
use \XModule\GridItem;
use \XModule\Traits\WithId;

const DEFAULT_GRID_OPTIONS = [
  'id' => null,
  'horizontalSpacing' => Spacing::TIGHT,
  'horizontalAlignment' => Position::LEFT,
  'containerPadding' => Spacing::NORMAL,
  'perItemPadding' => Spacing::TIGHT,
  'suppressVisibleLabels' => false,
];

class Grid extends Element
{
  use WithId;
  private $horizontalSpacing;
  private $horizontalAlignment;
  private $containerPadding;
  private $perItemPadding;
  private $suppressVisibleLabels;

  public function __construct(array $items, array $options = DEFAULT_GRID_OPTIONS)
  {
    parent::__construct(ElementType::GRID);

    $this->setItems($items);

    self::initId($options);

    if (isset($options['horizontalSpacing'])) {
      $this->setHorizontalSpacing($options['horizontalSpacing']);
    }
    if (isset($options['horizontalAlignment'])) {
      $this->setHorizontalAlignment($options['horizontalAlignment']);
    }
    if (isset($options['containerPadding'])) {
      $this->setContainerPadding($options['containerPadding']);
    }
    if (isset($options['perItemPadding'])) {
      $this->setPerItemPadding($options['perItemPadding']);
    }
    if (isset($options['suppressVisibleLabels'])) {
      $this->setLabelSuppression($options['suppressVisibleLabels']);
    }
  }

  public function setItems(array $items)
  {
    foreach ($items as $item) {
      $this->addItem($item);
    }
  }

  public function addItem(GridItem $item)
  {
    if (!$this->items) {
      $this->items = [];
    }
    array_push($this->items, $item);
  }

  public function setHorizontalSpacing(string $horizontalSpacing)
  {
    $this->horizontalSpacing = Spacing::validate($horizontalSpacing, $this->getElementType());
  }

  public function sethorizontalAlignment(string $horizontalAlignment)
  {
    $this->horizontalAlignment = Position::validate($horizontalAlignment, $this->getElementType());
  }

  public function setContainerPadding(string $containerPadding)
  {
    $this->containerPadding = Spacing::validate($containerPadding, $this->getElementType());
  }

  public function setPerItemPadding(string $perItemPadding)
  {
    $this->perItemPadding = Spacing::validate($perItemPadding, $this->getElementType());
  }

  public function setLabelSuppression(bool $suppressVisibleLabels)
  {
    $this->suppressVisibleLabels = $suppressVisibleLabels;
  }

  public function render()
  {
    $render = parent::render();
    $render['items'] = Functions::safeRender($this->items);

    self::renderId($render);

    if (isset($this->horizontalSpacing)) {
      $render['horizontalSpacing'] = $this->horizontalSpacing;
    }
    if (isset($this->horizontalAlignment)) {
      $render['horizontalAlignment'] = $this->horizontalAlignment;
    }
    if (isset($this->containerPadding)) {
      $render['containerPadding'] = $this->containerPadding;
    }
    if (isset($this->perItemPadding)) {
      $render['perItemPadding'] = $this->perItemPadding;
    }
    if (isset($this->suppressVisibleLabels)) {
      $render['suppressVisibleLabels'] = $this->suppressVisibleLabels;
    }

    return $render;
  }
}
