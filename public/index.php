<?php

ini_set('display_errors', 1);
error_reporting(~0);

session_start();
require_once "../app/Autoload.php";

$app = new Router();
$app->run();

SessionHelper::clearFlushMessages();

