<?php

define('BASE_PATH' , realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);

require_once(BASE_PATH . 'vendor/autoload.php');

$App = new Ignite\Application();
$App->run();