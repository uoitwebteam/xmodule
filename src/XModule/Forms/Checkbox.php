<?php
namespace XModule\Forms;

use \XModule\Base\FormControl;
use \XModule\Constants\CheckedState;
use \XModule\Constants\InputType;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithProgressiveDisclosureItems;

const DEFAULT_CHECKBOX_OPTIONS = [
  'description' => null,
  'progressiveDisclosureItems' => [],
  'checked' => false,
];

class Checkbox extends FormControl
{
  use WithDescription, WithProgressiveDisclosureItems;

  public function __construct(string $label, string $name, array $options = DEFAULT_CHECKBOX_OPTIONS)
  {
    parent::__construct(InputType::CHECKBOX, $label, $name);

    self::initDescription($options);
    self::initProgressiveDisclosureItems($options);
  }

  public function addProgressiveDisclosureItems(string $optionValue, $items)
  {
    if (!$this->progressiveDisclosureItems) {
      $this->progressiveDisclosureItems = [];
    }
    $checkedState = CheckedState::validate($optionValue, $this->getElementType());
    if (!isset($this->progressiveDisclosureItems[$checkedState])) {
      $this->progressiveDisclosureItems[$checkedState] = [];
    }
    if ($items instanceof AjaxContent) {
      $this->progressiveDisclosureItems[$checkedState] = $items;
    } else if (is_array($items)) {
      foreach ($items as $item) {
        $this->addProgressiveDisclosureItem($checkedState, $item);
      }
    } else {
      Functions::throwInvalidType($items, $this->getElementType(), 'progressive disclosure items');
    }
  }

  public function render()
  {
    $render = parent::render();

    self::renderDescription($render);
    self::renderProgressiveDisclosureItems($render);

    return $render;
  }
}
