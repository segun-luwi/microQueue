<?php


namespace App\Controller;

defined('APP_ROOT') or exit('No direct script access allowed');

/**
 * Class Error
 * @package App\Controller
 */
class Error extends AbstractController
{
  protected function content()
  {
    $this->response->send(["Encountered an error..."]);
  }
}
