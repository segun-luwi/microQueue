<?php

namespace Lib;

defined('APP_ROOT') or exit('No direct script access allowed');

/**
 * Class Request
 * @package Lib
 */
class Request
{
  public function raw(): array
  {
    try{
      $data = file_get_contents('php://input');
      if($this->isJson($data)) {
        return json_decode($data, true);
      }
      return array();
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

  private function isJson($string) {
    return (is_null(json_decode($string, TRUE))) ? FALSE : TRUE;
  }
}
