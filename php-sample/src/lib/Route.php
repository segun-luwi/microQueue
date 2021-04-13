<?php

namespace Lib;

defined('APP_ROOT') or exit('No direct script access allowed');

use ReflectionClass;

/**
 * Class Route
 * @package Lib
 */
class Route
{
  private $request;
  private $response;

  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
  }

  private function validated() : string
  {
    $preClass = "\\App\\Controller\\";
    $state = $this->request->query("state-type")[0];
    $state = $state === null ? "Root" : $state;

    if($state != "AbstractController" && class_exists($preClass . $state )) {
      return $preClass . $state;
    }
    return $preClass . "Error";
  }

  public function start()
  {
    $instance = $this->validated();
    try {
      $classBuilder = new ReflectionClass($instance);
      $controller = $classBuilder->newInstanceArgs([new Request(), new Response()]);
      $controller->serve();
    } catch (\ReflectionException $e) {
    }
  }
}
