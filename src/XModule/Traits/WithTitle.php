<?php
namespace XModule\Traits;

trait WithTitle
{
  private $title;

  public function initTitle(array $options)
  {
    if (isset($options['title'])) {
      $this->setTitle($options['title']);
    }
  }

  public function setTitle(string $title)
  {
    $this->title = $title;
  }

  public function renderTitle(&$render)
  {
    if (isset($this->title)) {
      $render['title'] = $this->title;
    }
  }
}
