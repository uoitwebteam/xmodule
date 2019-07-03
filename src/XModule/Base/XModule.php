<?php

namespace XModule\Base;

use \XModule\Shared\Functions;
use \XModule\Traits\WithContent;

const DEFAULT_XMODULE_OPTIONS = [
  'content' => [],
  'regionContent' => null,
];

class XModule
{
  use WithContent;

  const XMODULE_VERSION = 1;

  private $metadata;
  private $regionContent;

  public function __construct(int $version = self::XMODULE_VERSION, $options = DEFAULT_XMODULE_OPTIONS)
  {
    $this->setMetadata(['version' => $version]);

    self::initContent($options);

    if (isset($options['regionContent'])) {
      $this->setRegionContent($options['regionContent']);
    }
  }

  public function setRegionContent(array $regionContents)
  {
    foreach ($regionContents as $regionContent) {
      $this->addRegionContent($regionContent);
    }
  }

  public function addRegionContent($regionContent)
  {
    if (!isset($this->regionContent)) {
      $this->regionContent = [];
    }
    if (Functions::hasNamespace('XModule', $regionContent)) {
      array_push($this->regionContent, $regionContent);
    } else {
      Functions::throwInvalidType($regionContent, 'regionContent');
    }
  }

  public function setMetadata($metadata)
  {
    foreach ($metadata as $key => $value) {
      $this->addMetadata($key, $value);
    }
  }

  public function addMetadata(string $key, $value)
  {
    if (!$this->metadata) {
      $this->metadata = [];
    }
    $this->metadata[$key] = $value;
  }

  public function render()
  {
    $render = [
      'metadata' => Functions::safeRender($this->metadata),
    ];

    self::renderContent($render);

    if ($this->regionContent) {
      $render['regionContent'] = Functions::safeRender($this->regionContent);
    }

    return $render;
  }
}
