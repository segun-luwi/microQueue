<?php

namespace Lib;

use Noodlehaus\Config as configModule;
use Noodlehaus\AbstractConfig as configAbstractModule;

defined('APP_ROOT') or exit('No direct script access allowed');

/**
 * Class Config
 * @package Lib
 */
class Config extends configAbstractModule
{
  /**
   * Hold retrieved array
   * @var $value
   */
  public static $value;

  /**
   * Static initializer for config.
   */
  public static function init() {
    try {
      self::$value = configModule::load(APP_ROOT . "/config.yaml");
    } catch (\Exception $exception) {
      echo $exception;
    }
  }

}
