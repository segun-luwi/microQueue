<?php


namespace Lib;

defined('APP_ROOT') or exit('No direct script access allowed');

class Response
{

  public function send(array $content = []): void
  {
    header('Content-type: application/json; charset=utf-8');

    echo json_encode(array(
      "status" => "1",
      "data" => sizeof($content) == 1 && gettype($content[0]) === "string" ? $content[0] : $content
    ));
  }
}
