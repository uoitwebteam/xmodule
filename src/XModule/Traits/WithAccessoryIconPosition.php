<?php
namespace XModule\Traits;

use \XModule\Constants\AccessoryIconPosition;

trait WithAccessoryIconPosition
{
  private $accessoryIconPosition;

  public function initAccessoryIconPosition(array $options)
  {
    if (isset($options['accessoryIconPosition'])) {
      $this->setAccessoryIconPosition($options['accessoryIconPosition']);
    }
  }

  public function setAccessoryIconPosition(string $accessoryIconPosition)
  {
    $this->accessoryIconPosition = AccessoryIconPosition::validate($accessoryIconPosition, $this->getElementType());
  }

  public function renderAccessoryIconPosition(&$render)
  {
    if (isset($this->accessoryIconPosition)) {
      $render['accessoryIconPosition'] = $this->accessoryIconPosition;
    }
  }
}
