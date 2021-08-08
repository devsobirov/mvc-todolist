<?php

ini_set('display_errors', 1);
error_reporting(~0);

require_once "../app/Autoload.php";

$app = new Router();
$app->run();



