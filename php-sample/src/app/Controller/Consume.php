<?php

namespace App\Controller;

defined('APP_ROOT') or exit('No direct script access allowed');

class Consume extends AbstractController
{
  protected function content()
  {
    $this->response->send(["Consumer"]);
  }
}
