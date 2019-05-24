<?php
namespace XModule\Forms;

use \XModule\Base\FormControl;
use \XModule\Constants\InputType;

const DEFAULT_<%= constant %>_OPTIONS = [];

class <%= classname %> extends FormControl {

  public function __construct(string $label, string $name, array $options = DEFAULT_<%= constant %>_OPTIONS) {
    parent::__construct(InputType::<%= constant %>, $label, $name);
  }

  public function render() {
    $render = parent::render();
    return $render;
  }
}
