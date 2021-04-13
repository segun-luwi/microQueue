<?php


namespace App\Controller;

defined('APP_ROOT') or exit('No direct script access allowed');

/**
 * Class Root
 * @package App\Controller
 */
class Root extends AbstractController
{
  protected function content()
  {
    var_dump($this->config['rabbitmq']);
//    $this->response->send(["Index"]);
  }
}
