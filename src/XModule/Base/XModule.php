<?php

namespace XModule\Base;

use \XModule\Base\Metadata;
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

  public function __construct($metadata = null, $options = DEFAULT_XMODULE_OPTIONS)
  {
    if (is_numeric($metadata)) {
      $metadata = new Metadata(1);
    } else if (!$metadata) {
      $metadata = new Metadata();
    }
    $this->setMetadata($metadata);

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

  public function setMetadata(Metadata $metadata)
  {
    $this->metadata = $metadata;
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
