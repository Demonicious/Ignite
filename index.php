<?php

define('BASE_PATH' , __DIR__ . '/');

require_once(BASE_PATH . 'vendor/autoload.php');

$App = new Ignite\Application();
$App->run();