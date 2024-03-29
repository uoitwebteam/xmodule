<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Forms\FormButton;
use \XModule\LinkButton;
use \XModule\Shared\Functions;
use \XModule\Traits\WithId;

const DEFAULT_BUTTON_CONTAINER_OPTIONS = [
  'id' => null,
];

class ButtonContainer extends Element
{
  use WithId;
  private $buttons;

  public function __construct(array $buttons, array $options = DEFAULT_BUTTON_CONTAINER_OPTIONS)
  {
    parent::__construct(ElementType::BUTTON_CONTAINER);

    self::initId($options);

    $this->setButtons($buttons);
  }

  public function setButtons(array $buttons)
  {
    foreach ($buttons as $button) {
      $this->addButton($button);
    }
  }

  public function addButton($button)
  {
    if (!$this->buttons) {
      $this->buttons = [];
    }
    if ($button instanceof LinkButton || $button instanceof FormButton) {
      array_push($this->buttons, $button);
    } else {
      Functions::throwInvalidType($button, $this->getElementType(), 'button');
    }
  }

  public function render()
  {
    $render = parent::render();
    $render['buttons'] = Functions::safeRender($this->buttons);

    self::renderId($render);

    return $render;
  }
}
