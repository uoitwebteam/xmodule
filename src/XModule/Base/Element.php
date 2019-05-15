<?php

namespace XModule\Base;

use \XModule\Constants\ElementType;

class Element
{
  /**
   * The XModule element type of this module
   *
   * @var string
   */
  private $elementType;

  public function __construct(string $type)
  {
    $this->setElementType($type);
  }

  /**
   * Sets the type of XModule element for this module
   *
   * @param string $type
   * @return void
   */
  protected function setElementType(string $type)
  {
    $this->elementType = ElementType::validate($type, $this->getElementType());
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
