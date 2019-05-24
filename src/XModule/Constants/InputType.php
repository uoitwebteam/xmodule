<?php

namespace XModule\Constants;

use \XModule\Constants\Enum;

abstract class InputType extends Enum
{
  const CHECKBOX = 'checkbox';
  const EMAIL = 'email';
  const HIDDEN = 'hidden';
  const LABEL = 'label';
  const PASSWORD = 'password';
  const PHONE = 'phone';
  const RADIO = 'radio';
  const SELECT = 'select';
  const TEXT = 'text';
  const TEXTAREA = 'textarea';
  const UPLOAD = 'upload';
}
