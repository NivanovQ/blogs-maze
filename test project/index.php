<?php

use util\LogUtil;
use Illuminate\Database\Capsule\Manager as DB;

require __DIR__ . '/vendor/autoload.php';

session_start();

date_default_timezone_set("Europe/Sofia");

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';

set_error_handler(function ($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        // This error code is not included in error_reporting, so ignore it
        return;
    }
    //if error is before routing log is not defined yet
    if(LogUtil::$log != null){
        LogUtil::$log->error($message . " IN FILE " . $file . " ON LINE " . $line);
    }
    throw new \ErrorException($message, 0, $severity, $file, $line);
});

$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';
////Initialize Eloquent
$app->getContainer()->get("db");
//Initialize db - create it from script if schema is empty
DB::connection()->enableQueryLog();
$pdo = DB::connection()->getPdo();


// Register middleware
require __DIR__ . '/src/middleware.php';

// Register routes
require __DIR__ . '/src/routes.php';

// Run app
$app->run();
