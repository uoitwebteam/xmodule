<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Shared\Functions;
use \XModule\TableColumnOption;
use \XModule\TableRow;
use \XModule\Traits\WithHeading;
use \XModule\Traits\WithId;

const DEFAULT_TABLE_OPTIONS = [
  'id' => null,
  'heading' => null,
  'columnOptions' => [],
  'rows' => [],
];

class Table extends Element
{
  use WithId, WithHeading;
  private $columnOptions;
  private $rows;

  public function __construct(array $options = DEFAULT_TABLE_OPTIONS)
  {
    parent::__construct(ElementType::TABLE);

    self::initId($options);
    self::initHeading($options);

    if (isset($options['columnOptions'])) {
      $this->setColumnOptions($options['columnOptions']);
    }
    if (isset($options['rows'])) {
      $this->setRows($options['rows']);
    }
  }

  public function setColumnOptions(array $columnOptions)
  {
    foreach ($columnOptions as $columnOption) {
      $this->addColumnOption($columnOption);
    }
  }

  public function addColumnOption(TableColumnOption $columnOption)
  {
    if (!$this->columnOptions) {
      $this->columnOptions = [];
    }
    array_push($this->columnOptions, $columnOption);
  }

  public function setRows(array $rows)
  {
    $this->rows = [];
    foreach ($rows as $row) {
      $this->addRow($row);
    }
  }

  public function addRow(TableRow $row)
  {
    if (!$this->rows) {
      $this->rows = [];
    }
    array_push($this->rows, $row);
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);
    self::renderHeading($render);

    if (isset($this->columnOptions)) {
      $render['columnOptions'] = Functions::safeRender($this->columnOptions);
    }
    if (isset($this->rows)) {
      $render['rows'] = Functions::safeRender($this->rows);
    }

    return $render;
  }
}
