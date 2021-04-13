<?php

namespace App\Controller;

defined('APP_ROOT') or exit('No direct script access allowed');

/**
 * Class Publish
 * @package App\Controller
 */
class Publish extends AbstractController
{
  protected function content()
  {
    $this->response->send(["Publisher"]);
  }
}
