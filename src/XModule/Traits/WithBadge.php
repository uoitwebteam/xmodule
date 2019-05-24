<?php
namespace XModule\Traits;

use \XModule\Shared\Badge;
use \XModule\Shared\Functions;

trait WithBadge
{
  private $badge;

  public function initBadge(array $options)
  {
    if (isset($options['badge'])) {
      $this->setBadge($options['badge']);
    }
  }

  public function setBadge(Badge $badge)
  {
    $this->badge = $badge;
  }

  public function renderBadge(&$render)
  {
    if (isset($this->badge)) {
      $render['badge'] = Functions::safeRender($this->badge);
    }
  }
}
