<?php

require_once __DIR__ . '/vendor/autoload.php';

use DCSG\Application;
use DCSG\Command\CacheClearCommand;

$app = new Application('Clear Cache App', '0.0.1');
$app->add(new CacheClearCommand());
$app->run();