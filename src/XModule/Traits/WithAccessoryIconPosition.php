<?php
namespace XModule\Traits;

use \XModule\Constants\AccessoryIconPosition;

trait WithAccessoryIconPosition
{
  private $accessoryiconposition;

  public function initAccessoryIconPosition(array $options)
  {
    if (isset($options['accessoryiconposition'])) {
      $this->setAccessoryIconPosition($options['accessoryiconposition']);
    }
  }

  public function setAccessoryIconPosition(string $accessoryIconPosition)
  {
    $this->accessoryIconPosition = AccessoryIconPosition::validate($accessoryIconPosition, $this->getElementType());
  }

  public function renderAccessoryIconPosition(&$render)
  {
    if (isset($this->accessoryiconposition)) {
      $render['accessoryiconposition'] = $this->accessoryiconposition;
    }
  }
}
