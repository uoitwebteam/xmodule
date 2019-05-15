<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Shared\Functions;
use \XModule\Traits\WithId;

const DEFAULT_MULTICOLUMN_OPTIONS = [
  'id' => null,
];

class Multicolumn extends Element
{
  use WithId;
  private $columns;

  public function __construct(array $columns, array $options = DEFAULT_MULTICOLUMN_OPTIONS)
  {
    parent::__construct(ElementType::MULTICOLUMN);

    $this->setColumns($columns);

    self::initId($options);
  }

  public function setColumns(array $columns)
  {
    $this->columns = [];
    foreach ($columns as $column) {
      $this->addColumn($column);
    }
  }

  public function addColumn(array $column)
  {
    $validated = Functions::areAllOf($column, Element::class);
    if ($validated) {
      array_push($this->columns, $column);
    } else {
      Functions::throwInvalidType($column, $this->getElementType(), 'column');
    }
  }

  public function render()
  {
    $render = parent::render();
    $render['columns'] = Functions::safeRender($this->columns);

    self::renderId($render);

    return $render;
  }
}
