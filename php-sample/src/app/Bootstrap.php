<?php

/**
 * Bootstrap class
 */
namespace App;

defined('APP_ROOT') or exit('No direct script access allowed');

use Lib\Route;
use Lib\Request;
use Lib\Response;
use Lib\Config;

/**
 * Class Bootstrap
 * @package App
 */
class Bootstrap
{
  /**
   * @var Request
   */
  private $request;
  /**
   * @var Response
   */
  private $response;

  public function __construct(Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
  }

  public function Run():Void {
    /**
     * Inject config file.
     */
    Config::init();

    $r = new Route($this->request, $this->response);
    $r->start();
  }
}
