<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Constants\ElementType;
use \XModule\Constants\Height;
use \XModule\Traits\WithAjaxContent;
use \XModule\Traits\WithId;

const DEFAULT_PORTLET_OPTIONS = [
  'id' => null,
  'navbarTitle' => null,
  'navbarIcon' => null,
  'navbarLink' => null,
  'content' => [],
  'height' => null,
  'forceAjaxOnLoad' => true,
];

class Portlet extends Element
{
  use WithId, WithAjaxContent;
  private $navbarTitle;
  private $navbarIcon;
  private $navbarLink;
  private $height;
  private $forceAjaxOnLoad;

  public function __construct(array $options = DEFAULT_PORTLET_OPTIONS)
  {
    parent::__construct(ElementType::PORTLET);

    self::initId($options);
    self::initContent($options);

    if (isset($options['navbarTitle'])) {
      $this->setNavbarTitle($options['navbarTitle']);
    }
    if (isset($options['navbarIcon'])) {
      $this->setNavbarIcon($options['navbarIcon']);
    }
    if (isset($options['navbarLink'])) {
      $this->setNavbarLink($options['navbarLink']);
    }
    if (isset($options['height'])) {
      $this->setHeight($options['height']);
    }
    if (isset($options['forceAjaxOnLoad'])) {
      $this->setForceAjaxOnLoad($options['forceAjaxOnLoad']);
    }
  }

  public function setNavbarTitle(string $navbarTitle)
  {
    $this->navbarTitle = $navbarTitle;
  }

  public function setNavbarIcon(string $navbarIcon)
  {
    $this->navbarIcon = $navbarIcon;
  }

  public function setNavbarLink(string $navbarLink)
  {
    $this->navbarLink = $navbarLink;
  }

  public function setHeight(string $height)
  {
    $this->height = Height::validate($height, $this->getElementType());
  }

  public function setForceAjaxOnLoad(bool $forceAjaxOnLoad)
  {
    $this->forceAjaxOnLoad = $forceAjaxOnLoad;
  }

  public function render()
  {
    $render = parent::render();

    self::renderId($render);
    self::renderContent($render);

    if (isset($this->navbarTitle)) {
      $render['navbarTitle'] = $this->navbarTitle;
    }
    if (isset($this->navbarIcon)) {
      $render['navbarIcon'] = $this->navbarIcon;
    }
    if (isset($this->navbarLink)) {
      $render['navbarLink'] = $this->navbarLink;
    }
    if (isset($this->height)) {
      $render['height'] = $this->height;
    }
    if (isset($this->forceAjaxOnLoad)) {
      $render['forceAjaxOnLoad'] = $this->height;
    }

    return $render;
  }
}
