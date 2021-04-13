<?php

/**
 * App root
 */
define("APP_ROOT", __DIR__);

require_once('vendor/autoload.php');

use App\Bootstrap;
use Lib\Request;
use Lib\Response;

$app = new Bootstrap(new Request(), new Response());
$app->Run();
