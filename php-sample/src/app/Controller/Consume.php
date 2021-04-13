<?php

namespace App\Controller;

use Lib\AbstractController;
use Lib\Queue;

defined('APP_ROOT') or exit('No direct script access allowed');

/**
 * Class Consume
 * @package App\Controller
 */
class Consume extends AbstractController
{
  protected function content()
  {
    $queue = new Queue();
    $queue->consume();
    $this->response->send(["Consumer is working.."]);
  }
}
