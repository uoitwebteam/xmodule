<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class LayoutType extends Enum
{
  const MONDRIAN = 'mondrian';
  const COLLAGE = 'collage';
  const CARDNAV = 'cardnav';
  const LAUNCHPAD = 'launchpad';
}
