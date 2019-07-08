<?php
namespace XModule\Base;

use \XModule\Shared\Banner;

const DEFAULT_METADATA_OPTIONS = [
  'banners' => null,
];

class Metadata
{
  const XMODULE_VERSION = 1;
  private $version;
  private $banners;

  public function __construct(int $version = self::XMODULE_VERSION, array $options = DEFAULT_METADATA_OPTIONS)
  {
    $this->setVersion($version);
    if (isset($options['banners'])) {
      $this->setBanners($options['banners']);
    }
  }

  public function setVersion(int $version)
  {
    $this->version = $version;
  }

  public function setBanners(array $banners)
  {
    foreach ($banners as $item) {
      $this->addItem($item);
    }
  }

  public function addItem(Banner $item)
  {
    if (!$this->banners) {
      $this->banners = [];
    }
    array_push($this->banners, $item);
  }

  public function render()
  {
    $render = ['version' => $this->version];
    if (isset($this->banners)) {
      $render['banners'] = Functions::safeRender($this->banners);
    }
    return $render;
  }
}
