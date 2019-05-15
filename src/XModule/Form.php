<?php

namespace XModule;

use \XModule\Base\Element;
use \XModule\Base\FormElement;
use \XModule\Constants\ElementType;
use \XModule\Constants\PostType;
use \XModule\Shared\Functions;
use \XModule\Traits\WithHeading;
use \XModule\Traits\WithId;

const DEFAULT_FORM_OPTIONS = [
  'id' => null,
  'postType' => PostType::FOREGROUND,
  'heading' => null,
  'disableScrim' => false,
  'loadingTitle' => 'Loading',
];

class Form extends Element
{

  use WithId, WithHeading;
  private $items;
  private $postRelativePath;
  private $postType;
  private $disableScrim;
  private $loadingTitle;

  public function __construct(array $items, string $postRelativePath, $options = DEFAULT_FORM_OPTIONS)
  {
    parent::__construct(ElementType::FORM);

    $this->setItems($items);
    $this->setPostRelativePath($postRelativePath);

    self::initId($options);
    self::initHeading($options);

    if (isset($options['postType'])) {
      $this->setPostType($options['postType']);
    }
    if (isset($options['disableScrim'])) {
      $this->setDisableScrim($options['disableScrim']);
    }
    if (isset($options['loadingTitle'])) {
      $this->setLoadingTitle($options['loadingTitle']);
    }
  }

  public function setItems(array $items)
  {
    if (!$this->items) {
      $this->items = [];
    }
    foreach ($items as $item) {
      $this->addItem($item);
    }
  }

  public function addItem($item)
  {
    if (
      is_subclass_of($item, FormElement::class)
      || Functions::isOneOf($item, [
        \XModule\ButtonContainer::class,
        \XModule\Collapsible::class,
        \XModule\Heading::class,
        \XModule\Html::class,
        \XModule\Table::class,
        \XModule\Image::class,
      ])
    ) {
      array_push($this->items, $item);
    } else {
      Functions::throwInvalidType($item, $this->getElementType());
    }
  }

  public function setPostRelativePath(string $postRelativePath)
  {
    $this->postRelativePath = $postRelativePath;
  }

  public function setPostType(string $postType)
  {
    $this->postType = PostType::validate($postType, $this->getElementType());
  }

  public function setDisableScrim(bool $disableScrim)
  {
    $this->disableScrim = $disableScrim;
  }

  public function setLoadingTitle(string $loadingTitle)
  {
    $this->loadingTitle = $loadingTitle;
  }

  public function render()
  {
    $render = parent::render();
    $render['items'] = Functions::safeRender($this->items);
    $render['postRelativePath'] = $this->postRelativePath;

    self::renderId($render);
    self::renderHeading($render);

    if (isset($this->postType)) {
      $render['postType'] = $this->postType;
    }
    if (isset($this->disableScrim)) {
      $render['disableScrim'] = $this->disableScrim;
    }
    if (isset($this->loadingTitle)) {
      $render['loadingTitle'] = $this->loadingTitle;
    }

    return $render;
  }
}
