<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Traits\WithId;

const DEFAULT_HTML_OPTIONS = [
  'id' => null,
  'html' => null,
  'focal' => true,
  'inset' => true,
];

class Html extends Element
{
  use WithId;
  private $html;
  private $focal;
  private $inset;

  public function __construct(array $options = DEFAULT_HTML_OPTIONS)
  {
    parent::__construct(ElementType::HTML);

    self::initId($options);

    if (isset($options['html'])) {
      $this->setHtml($options['html']);
    }
    if (isset($options['focal'])) {
      $this->setFocal($options['focal']);
    }
    if (isset($options['inset'])) {
      $this->setInset($options['inset']);
    }
  }

  public function setHtml(string $html)
  {
    $this->html = $html;
  }

  public function setFocal(bool $focal)
  {
    $this->focal = $focal;
  }

  public function setInset(bool $inset)
  {
    $this->inset = $inset;
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);

    if (isset($this->html)) {
      $render['html'] = $this->html;
    }
    if (isset($this->focal)) {
      $render['focal'] = $this->focal;
    }
    if (isset($this->inset)) {
      $render['inset'] = $this->inset;
    }
    return $render;
  }
}
