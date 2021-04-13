<?php

namespace Lib;

/**
 * Class Request
 * @package Lib
 */
class Request
{
  public function raw(): array
  {
    try{
      return json_decode(file_get_contents('php://input'));
    } catch (\Exception $exception) {
      return array();
    }

  }

  public function query($pick = null): array
  {
    try {
      return $pick === null ? $_REQUEST : [$_REQUEST[$pick]];
    } catch (\Exception $exception) {
      return array();
    }

  }
}
