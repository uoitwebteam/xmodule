<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\AspectRatio;
use \XModule\Constants\BaseLayer;
use \XModule\Constants\ElementType;
use \XModule\Shared\AjaxContent;
use \XModule\Traits\WithId;

const DEFAULT_GOOGLE_MAP_OPTIONS = [
  'id' => null,
  'initialLatitude' => 0.0,
  'initialLongitude' => 0.0,
  'initialZoomLevel' => null,
  'disableZoomToPlacemarks' => false,
  'defaultToUserLocated' => false,
  'minZoomLevel' => null,
  'maxZoomLevel' => null,
  'aspectRatio' => AspectRatio::ONE_TO_ONE,
  'inset' => false,
  'showUserLocationButton' => true,
  'showRecenterButton' => true,
  'showZoomButtons' => true,
  'baseLayers' => [BaseLayer::ROADMAP],
  'staticPlacemarks' => null,
  'dynamicPlacemarks' => null,
];

class GoogleMap extends Element
{
  use WithId;
  private $initialLatitude;
  private $initialLongitude;
  private $initialZoomLevel;
  private $disableZoomToPlacemarks;
  private $defaultToUserLocated;
  private $minZoomLevel;
  private $maxZoomLevel;
  private $aspectRatio;
  private $inset;
  private $showUserLocationButton;
  private $showRecenterButton;
  private $showZoomButtons;
  private $baseLayers;
  private $staticPlacemarks;
  private $dynamicPlacemarks;

  public function __construct(array $options = DEFAULT_GOOGLE_MAP_OPTIONS)
  {
    parent::__construct(ElementType::GOOGLE_MAP);

    self::initId($options);

    if (isset($options['initialLatitude'])) {
      $this->setInitialLatitude($options['initialLatitude']);
    }
    if (isset($options['initialLongitude'])) {
      $this->setInitialLongitude($options['initialLongitude']);
    }
    if (isset($options['initialZoomLevel'])) {
      $this->setInitialZoomLevel($options['initialZoomLevel']);
    }
    if (isset($options['disableZoomToPlacemarks'])) {
      $this->setDisableZoomToPlacemarks($options['disableZoomToPlacemarks']);
    }
    if (isset($options['defaultToUserLocated'])) {
      $this->setDefaultToUserLocated($options['defaultToUserLocated']);
    }
    if (isset($options['minZoomLevel'])) {
      $this->setMinZoomLevel($options['minZoomLevel']);
    }
    if (isset($options['maxZoomLevel'])) {
      $this->setMaxZoomLevel($options['maxZoomLevel']);
    }
    if (isset($options['aspectRatio'])) {
      $this->setAspectRatio($options['aspectRatio']);
    }
    if (isset($options['inset'])) {
      $this->setInset($options['inset']);
    }
    if (isset($options['showUserLocationButton'])) {
      $this->setShowUserLocationButton($options['showUserLocationButton']);
    }
    if (isset($options['showRecenterButton'])) {
      $this->setShowRecenterButton($options['showRecenterButton']);
    }
    if (isset($options['showZoomButtons'])) {
      $this->setShowZoomButtons($options['showZoomButtons']);
    }
    if (isset($options['baseLayers'])) {
      $this->setBaseLayers($options['baseLayers']);
    }
    if (isset($options['staticPlacemarks'])) {
      $this->setStaticPlacemarks($options['staticPlacemarks']);
    }
    if (isset($options['dynamicPlacemarks'])) {
      $this->setDynamicPlacemarks($options['dynamicPlacemarks']);
    }
  }

  public function setInitialLatitude(float $initialLatitude)
  {
    $this->initialLatitude = $initialLatitude;
  }

  public function setInitialLongitude(float $initialLongitude)
  {
    $this->initialLongitude = $initialLongitude;
  }

  public function setInitialZoomLevel(int $initialZoomLevel)
  {
    $this->initialZoomLevel = $initialZoomLevel;
  }

  public function setDisableZoomToPlacemarks(bool $disableZoomToPlacemarks)
  {
    $this->disableZoomToPlacemarks = $disableZoomToPlacemarks;
  }

  public function setDefaultToUserLocated(bool $defaultToUserLocated)
  {
    $this->defaultToUserLocated = $defaultToUserLocated;
  }

  public function setMinZoomLevel(int $minZoomLevel)
  {
    $this->minZoomLevel = $minZoomLevel;
  }

  public function setMaxZoomLevel(int $maxZoomLevel)
  {
    $this->maxZoomLevel = $maxZoomLevel;
  }

  public function setAspectRatio(string $aspectRatio)
  {
    $this->aspectRatio = AspectRatio::validate($aspectRatio, $this->getElementType());
  }

  public function setInset(bool $inset)
  {
    $this->inset = $inset;
  }

  public function setShowUserLocationButton(bool $showUserLocationButton)
  {
    $this->showUserLocationButton = $showUserLocationButton;
  }

  public function setShowRecenterButton(bool $showRecenterButton)
  {
    $this->showRecenterButton = $showRecenterButton;
  }

  public function setShowZoomButtons(bool $showZoomButtons)
  {
    $this->showZoomButtons = $showZoomButtons;
  }

  public function setBaseLayers(array $baseLayers)
  {
    foreach ($baseLayers as $baseLayer) {
      $this->addBaseLayer($baseLayer);
    }
  }

  public function addBaseLayer(string $baseLayer)
  {
    if (!$this->baseLayers) {
      $this->baseLayers = [];
    }
    array_push($this->baseLayers, BaseLayer::validate($baseLayer, $this->getElementType()));
  }

  public function setStaticPlacemarks(array $staticPlacemarks)
  {
    foreach ($staticPlacemarks as $staticPlacemark) {
      $this->addStaticPlacemark($staticPlacemark);
    }
  }

  public function addStaticPlacemark($staticPlacemark)
  {
    if (!$this->staticPlacemarks) {
      $this->staticPlacemarks = [];
    }
    if (
      Functions::isOneOf($staticPlacemark, [
        \XModule\MapPoint::class,
        \XModule\MapPolygon::class,
        \XModule\MapPolyline::class,
      ])
    ) {
      array_push($this->staticPlacemarks, $staticPlacemark);
    } else {
      Functions::throwInvalidType($staticPlacemark, $this->getElementType(), 'static placemark');
    }
  }

  public function setDynamicPlacemarks(AjaxContent $dynamicPlacemarks)
  {
    $this->dynamicPlacemarks = $dynamicPlacemarks;
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);

    if (isset($this->initialLatitude)) {
      $render['initialLatitude'] = $this->initialLatitude;
    }
    if (isset($this->initialLongitude)) {
      $render['initialLongitude'] = $this->initialLongitude;
    }
    if (isset($this->initialZoomLevel)) {
      $render['initialZoomLevel'] = $this->initialZoomLevel;
    }
    if (isset($this->disableZoomToPlacemarks)) {
      $render['disableZoomToPlacemarks'] = $this->disableZoomToPlacemarks;
    }
    if (isset($this->defaultToUserLocated)) {
      $render['defaultToUserLocated'] = $this->defaultToUserLocated;
    }
    if (isset($this->minZoomLevel)) {
      $render['minZoomLevel'] = $this->minZoomLevel;
    }
    if (isset($this->maxZoomLevel)) {
      $render['maxZoomLevel'] = $this->maxZoomLevel;
    }
    if (isset($this->aspectRatio)) {
      $render['aspectRatio'] = $this->aspectRatio;
    }
    if (isset($this->inset)) {
      $render['inset'] = $this->inset;
    }
    if (isset($this->showUserLocationButton)) {
      $render['showUserLocationButton'] = $this->showUserLocationButton;
    }
    if (isset($this->showRecenterButton)) {
      $render['showRecenterButton'] = $this->showRecenterButton;
    }
    if (isset($this->showZoomButtons)) {
      $render['showZoomButtons'] = $this->showZoomButtons;
    }
    if (isset($this->baseLayers)) {
      $render['baseLayers'] = $this->baseLayers;
    }
    if (isset($this->staticPlacemarks)) {
      $render['staticPlacemarks'] = $this->staticPlacemarks;
    }
    if (isset($this->dynamicPlacemarks)) {
      $render['dynamicPlacemarks'] = $this->dynamicPlacemarks;
    }

    return $render;
  }
}
