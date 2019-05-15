<?php
namespace XModule\Forms;

use \XModule\Base\FormControl;
use \XModule\Constants\InputType;
use \XModule\Shared\Functions;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithProgressiveDisclosureItems;
use \XModule\Traits\WithRequired;
use \XModule\Traits\WithValue;

const DEFAULT_RADIO_OPTIONS = [
  'description' => null,
  'optionLabels' => [],
  'optionValues' => [],
  'value' => null,
  'required' => false,
  'progressiveDisclosureItems' => [],
];

class Radio extends FormControl
{
  use WithDescription, WithProgressiveDisclosureItems, WithRequired, WithValue;
  private $optionLabels;
  private $optionValues;

  public function __construct(array $options = DEFAULT_RADIO_OPTIONS)
  {
    parent::__construct(InputType::RADIO);

    self::initDescription($options);
    self::initProgressiveDisclosureItems($options);
    self::initRequired($options);
    self::initValue($options);

    if (isset($options['optionLabels'])) {
      $this->setOptionLabels($options['optionLabels']);
    }
    if (isset($options['optionValues'])) {
      $this->setOptionValues($options['optionValues']);
    }
  }

  public function setOptionLabels(array $optionLabels)
  {
    foreach ($optionLabels as $optionLabel) {
      $this->addOptionLabel($optionLabel);
    }
  }

  public function addOptionLabel(string $optionLabel)
  {
    if (!$this->optionLabels) {
      $this->optionLabels = [];
    }
    array_push($this->optionLabels, $optionLabel);
  }

  public function setOptionValues(array $optionValues)
  {
    foreach ($optionValues as $optionValue) {
      $this->addOptionValue($optionValue);
    }
  }

  public function addOptionValue(string $optionValue)
  {
    if (!$this->optionValues) {
      $this->optionValues = [];
    }
    array_push($this->optionValues, $optionValue);
  }

  public function render()
  {
    $render = parent::render();
    self::renderDescription($render);
    self::renderProgressiveDisclosureItems($render);
    self::renderRequired($render);
    self::renderValue($render);

    if (isset($this->optionLabels)) {
      $render['optionLabels'] = $this->optionLabels;
    }
    if (isset($this->optionValues)) {
      $render['optionValues'] = $this->optionValues;
    }
    if (isset($this->progressiveDisclosureItems)) {
      $render['progressiveDisclosureItems'] = Functions::safeRender($this->progressiveDisclosureItems);
    }

    return $render;
  }
}
