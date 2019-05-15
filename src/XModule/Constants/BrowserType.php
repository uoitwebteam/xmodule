<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class BrowserType extends Enum
{
  const APP_MODAL = 'appModal';
  const APP_SCREEN = 'appScreen';
  const SYSTEM_EMBEDDED = 'systemBrowserEmbedded';
  const SYSTEM_EXTERNAL = 'systemBrowserExternal';
}
