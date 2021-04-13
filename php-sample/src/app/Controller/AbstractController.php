<?php

namespace App\Controller;

defined('APP_ROOT') or exit('No direct script access allowed');

use Lib\Config;
use Lib\Request;
use Lib\Response;

/**
 * Class AbstractController
 * @package App\Controller
 */
class AbstractController
{
  protected $response;
  protected $request;
  protected $config;


  public function __construct( Request $request, Response $response)
  {
    $this->request = $request;
    $this->response = $response;
    $this->config = Config::$value;
  }

  protected function content()
  {
    $this->response->send(["No content.."]);
  }

  public function serve()
  {
    $this->content();
  }

}
