<?php

$rawJson = file_get_contents('php://input');
ob_start();
var_dump($rawJson . "\n");

file_put_contents('logs.txt', $rawJson.PHP_EOL , FILE_APPEND | LOCK_EX);
error_log(ob_get_clean(), 4);
