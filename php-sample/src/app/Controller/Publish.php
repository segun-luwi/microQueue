<?php

namespace App\Controller;

use Lib\Queue;

defined('APP_ROOT') or exit('No direct script access allowed');

/**
 * Class Publish
 * @package App\Controller
 */
class Publish extends AbstractController
{
  protected function content()
  {
    $queue = new Queue();
    $queue->publish();
    $this->response->send(["Publisher"]);
  }
}
