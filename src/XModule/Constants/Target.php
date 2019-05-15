<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class Target extends Enum
{
  const PARENT = 'parent';
  const GRANDPARENT = 'grandparent';
  const MODULE = 'module';
  const HOME = 'home';
  const NONE = 'none';
}
