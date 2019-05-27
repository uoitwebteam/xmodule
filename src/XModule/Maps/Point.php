<?php

namespace XModule\Maps;

class Point
{
  private $latitude;
  private $longitude;

  public function __construct(float $latitude, float $longitude)
  {
    $this->setLatitude($latitude);
    $this->setLongitude($longitude);
  }

  public function setLatitude(float $latitude)
  {
    $this->latitude = $latitude;
  }

  public function setLongitude(float $longitude)
  {
    $this->longitude = $longitude;
  }

  public function render()
  {
    $render = [
      'latitude' => $this->latitude,
      'longitude' => $this->longitude,
    ];
    return $render;
  }
}
