<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class ActionType extends Enum
{
  const CONSTRUCTIVE = 'constructive';
  const DESTRUCTIVE = 'destructive';
  const EMPHASIZED = 'emphasized';
}
