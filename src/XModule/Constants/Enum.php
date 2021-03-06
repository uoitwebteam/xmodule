<?php

namespace XModule\Constants;

use \XModule\Shared\Functions;

abstract class Enum
{
  private static $constCacheArray = null;

  private function __construct()
  { /* empty! */}

  private static function getConstants()
  {
    if (self::$constCacheArray === null) {
      self::$constCacheArray = [];
    }
    $calledClass = get_called_class();
    if (!array_key_exists($calledClass, self::$constCacheArray)) {
      $reflect = new \ReflectionClass($calledClass);
      self::$constCacheArray[$calledClass] = $reflect->getConstants();
    }
    return self::$constCacheArray[$calledClass];
  }

  public static function validateKey($key, $strict = false)
  {
    $constants = self::getConstants();
    if ($strict) {
      return array_key_exists($key, $constants);
    }
    $keys = array_map('strtolower', array_keys($constants));
    return in_array(strtolower($name), $keys);
  }

  public static function validateValue($value)
  {
    $values = array_values(self::getConstants());
    return in_array($value, $values, $strict = true);
  }

  public static function validate($value, $element = 'element')
  {
    if (self::validateValue($value)) {
      return $value;
    } else {
      $calledClass = get_called_class();
      $reflect = new \ReflectionClass($calledClass);
      $className = self::getPlainClassname($reflect->getShortName());
      $elementType = self::getPlainClassname($element);
      Functions::throwInvalidType($value, $elementType, $className);
    }
  }

  private static function getPlainClassname($name)
  {
    return strtolower(implode(' ', preg_split('/(?=[A-Z])/', $name)));
  }
}
