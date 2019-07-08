<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class BannerType extends Enum
{
  const INFO = 'info';
  const ALARM = 'alarm';
  const WARNING = 'warning';
  const CONFIRMATION = 'confirmation';
  const DEBUG = 'debug';
}
