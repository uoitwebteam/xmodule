<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class BaseLayer extends Enum
{
  const ROADMAP = 'roadmap';
  const SATELLITE = 'satellite';
  const HYBRID = 'hybrid';
  const TERRAIN = 'terrain';
}
