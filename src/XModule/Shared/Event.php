<?php

namespace XModule\Shared;

use \XModule\Constants\EventAction;
use \XModule\Constants\EventName;

const DEFAULT_EVENT_OPTIONS = [
  'useRelativePathToUpdate' => false,
];

class Event
{
  private $eventName;
  private $targetId;
  private $action;
  private $useRelativePathToUpdate;

  public function __construct($eventName, $targetId, $action, array $options = DEFAULT_EVENT_OPTIONS)
  {

    $this->setEventName($eventName);
    $this->setTargetId($targetId);
    $this->setAction($action);

    if (isset($useRelativePathToUpdate)) {
      $this->setUseRelativePathToUpdate($options['useRelativePathToUpdate']);
    }
  }

  public function setEventName(string $eventName)
  {
    $this->eventName = EventName::validate($eventName, 'event', 'name');
  }

  public function setTargetId(string $targetId)
  {
    $this->targetId = $targetId;
  }

  public function setAction(string $action)
  {
    $this->action = EventAction::validate($action, 'event', 'action');
  }

  public function setUseRelativePathToUpdate(bool $useRelativePathToUpdate)
  {
    $this->useRelativePathToUpdate = $useRelativePathToUpdate;
  }

  public function render()
  {
    $render = [
      'eventName' => $this->eventName,
      'targetId' => $this->targetId,
      'action' => $this->action,
    ];

    if (isset($this->useRelativePathToUpdate)) {
      $render['useRelativePathToUpdate'] = $this->useRelativePathToUpdate;
    }

    return $render;
  }
}
