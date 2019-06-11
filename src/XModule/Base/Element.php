<?php

namespace XModule\Base;

use \XModule\Constants\ElementType;
use \XModule\Constants\LayoutType;
use \XModule\Constants\ModuleType;
use \XModule\Shared\Functions;

class Element
{
  /**
   * The XModule element type of this module
   *
   * @var string
   */
  private $elementType;

  public function __construct($type)
  {
    $this->setElementType($type);
  }

  /**
   * Sets the type of XModule element for this module
   *
   * @param string $type
   * @return void
   */
  protected function setElementType($type)
  {
    if (is_array($type)) {
      $this->elementType = implode(':', [
        ModuleType::validate($type[0], 'element'),
        LayoutType::validate($type[1], 'element'),
        ElementType::validate($type[2], 'element'),
      ]);
    } else if (is_string($type)) {
      $this->elementType = ElementType::validate($type, $this->getElementType());
    } else {
      Functions::throwInvalidType($type, 'element', 'type');
    }
  }

  /**
   * Returns the type of XModule element for this module
   *
   * @return string
   */
  protected function getElementType()
  {
    return $this->elementType;
  }

  /**
   * Render the XModule element's output
   *
   * @return array
   */
  public function render()
  {
    return [
      'elementType' => $this->elementType,
    ];
  }
}
