<?php

namespace App\Controller;

use Lib\AbstractController;
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
    $queue->publish(json_encode($this->request->raw()));
    $this->response->send(["Published successfully.."]);
  }
}
