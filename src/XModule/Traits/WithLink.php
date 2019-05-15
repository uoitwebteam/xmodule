<?php
namespace XModule\Traits;

use \XModule\Shared\Functions;
use \XModule\Shared\Link;

trait WithLink
{
  private $link;

  public function initLink(array $options)
  {
    if (isset($options['link'])) {
      $this->setLink($options['link']);
    }
  }

  public function setLink(Link $link)
  {
    $this->link = $link;
  }

  public function renderLink(&$render)
  {
    if (isset($this->link)) {
      $render['link'] = Functions::safeRender($this->link);
    }
  }
}
