<?php
namespace XModule\Traits;

/**
 * Trait for modules with an `id` property
 */
trait WithId
{
  /**
   * The module ID
   *
   * @var string
   */
  private $id;

  /**
   * Initialize the module's ID
   *
   * @param array $options
   * @return void
   */
  public function initId(array $options)
  {
    if (isset($options['id'])) {
      $this->setId($options['id']);
    }
  }

  /**
   * Set the module's ID
   *
   * @param string $id
   * @return void
   */
  public function setId(string $id)
  {
    $this->id = $id;
  }

  /**
   * Add the module's ID to its render output
   *
   * @param array $render
   * @return void
   */
  public function renderId(array &$render)
  {
    if (isset($this->id)) {
      $render['id'] = $this->id;
    }
  }
}
