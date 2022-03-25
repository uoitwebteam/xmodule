<?php
namespace XModule\Base;

use \XModule\Shared\Banner;
use \XModule\Shared\Functions;
use \XModule\Shared\SearchOptions;

const DEFAULT_METADATA_OPTIONS = [
  'banners' => null,
  'searchOptions' => null,
];

class Metadata
{
  const XMODULE_VERSION = 2;
  private $version;
  private $banners;
  private $searchOptions;

  public function __construct(int $version = self::XMODULE_VERSION, array $options = DEFAULT_METADATA_OPTIONS)
  {
    $this->setVersion($version);

    if (isset($options['banners'])) {
      $this->setBanners($options['banners']);
    }
    if (isset($options['searchOptions'])) {
      $this->setsearchOptions($options['searchOptions']);
    }
  }

  public function setVersion(int $version)
  {
    $this->version = $version;
  }

  public function setBanners(array $banners)
  {
    foreach ($banners as $banner) {
      $this->addBanner($banner);
    }
  }

  public function addBanner(Banner $banner)
  {
    if (!$this->banners) {
      $this->banners = [];
    }
    array_push($this->banners, $banner);
  }

  public function setSearchOptions(SearchOptions $searchOptions)
  {
    $this->searchOptions = $searchOptions;
  }

  public function render()
  {
    $render = ['version' => $this->version];

    if (isset($this->banners)) {
      $render['banners'] = Functions::safeRender($this->banners);
    }
    if (isset($this->searchOptions)) {
      $render['searchOptions'] = Functions::safeRender($this->searchOptions);
    }
    return $render;
  }
}
