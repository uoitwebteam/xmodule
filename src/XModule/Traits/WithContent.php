<?php
namespace XModule\Traits;

use \XModule\Base\Element;
use \XModule\Shared\Functions;

/**
 * Trait for modules with an `content` property
 */
trait WithContent
{
  /**
   * The module's content
   *
   * @var Element[]
   */
  private $content;

  /**
   * Initialize the module's content
   *
   * @param array $options The parent module's `$options` array
   * @return void
   */
  public function initContent(array $options)
  {
    if (isset($options['content'])) {
      $this->setContent($options['content']);
    }
  }

  /**
   * Set the module's content
   *
   * @param array $content An array of content to set
   * @return void
   */
  public function setContent(array $content)
  {
    foreach ($content as $item) {
      $this->addContent($item);
    }
  }

  /**
   * Add an element to the module's content
   *
   * @param Element $item A content element to add
   * @return void
   */
  public function addContent($item)
  {
    if ($item instanceof Element) {
      if (!$this->content) {
        $this->content = [];
      }
      array_push($this->content, $item);
    } else {
      Functions::throwInvalidType($item, $this->getElementType(), 'content item');
    }
  }

  /**
   * Add the module's content to its render output
   *
   * @param array $render
   * @return void
   */
  public function renderContent(&$render)
  {
    if (isset($this->content) && !empty($this->content)) {
      $render['content'] = Functions::safeRender($this->content);
    }
  }
}
