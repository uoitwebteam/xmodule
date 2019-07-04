<?php
namespace XModule\Traits;

use \XModule\Shared\Event;
use \XModule\Shared\Functions;

trait WithEvents
{
  private $events;

  public function initEvents(array $options)
  {
    if (isset($options['events'])) {
      $this->setEvents($options['events']);
    }
  }

  public function setEvents(array $events)
  {
    foreach ($events as $event) {
      $this->addEvent($event);
    }
  }

  public function addEvent(Event $event)
  {
    if (!$this->events) {
      $this->events = [];
    }
    array_push($this->events, $event);
  }

  public function renderEvents(&$render)
  {
    if (isset($this->events)) {
      $render['events'] = Functions::safeRender($this->events);
    }
  }
}
