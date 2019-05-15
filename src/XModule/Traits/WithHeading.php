<?php
namespace XModule\Traits;

trait WithHeading
{
  private $heading;

  public function initHeading(array $options)
  {
    if (isset($options['heading'])) {
      $this->setHeading($options['heading']);
    }
  }

  public function setHeading(string $heading)
  {
    $this->heading = $heading;
  }

  public function renderHeading(&$render)
  {
    if (isset($this->heading)) {
      $render['heading'] = $this->heading;
    }
  }
}
