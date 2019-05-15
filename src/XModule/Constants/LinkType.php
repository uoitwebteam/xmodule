<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class LinkType extends Enum
{
  const RELATIVE_PATH = 'relativePath';
  const EXTERNAL = 'external';
  const MODULE = 'module';
  const XMODULE = 'xmodule';
  const NATIVE_PLUGIN = 'nativePlugin';
}
