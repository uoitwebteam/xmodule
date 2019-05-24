<?php
namespace XModule\Forms;

use \XModule\Base\FormControl;
use \XModule\Constants\InputType;
use \XModule\Traits\WithDescription;
use \XModule\Traits\WithRequired;

const DEFAULT_UPLOAD_OPTIONS = [
  'description' => null,
  'value' => null,
  'maxFileSize' => null,
];

class Upload extends FormControl
{
  use WithDescription, WithRequired;
  private $maxFileSize;

  public function __construct(string $label, string $name, array $options = DEFAULT_UPLOAD_OPTIONS)
  {
    parent::__construct(InputType::UPLOAD, $label, $name);

    self::initDescription($options);
    self::initRequired($options);

    if (isset($options['maxFileSize'])) {
      $this->setMaxFileSize($options['maxFileSize']);
    }
  }

  public function setMaxFileSize(int $maxFileSize)
  {
    $this->maxFileSize = $maxFileSize;
  }

  public function render()
  {
    $render = parent::render();

    self::renderDescription($render);
    self::renderRequired($render);

    if (isset($this->maxFileSize)) {
      $render['maxFileSize'] = $this->maxFileSize;
    }

    return $render;
  }
}
