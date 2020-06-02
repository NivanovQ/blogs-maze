<?php
// Application middleware
use util\LogUtil;

use controller\auth\AuthProvider;
use \controller\DBController;


$app->add(function ($request, $response, $next) {
    LogUtil::registerLogger($this->logger);
    LogUtil::registerSQLLogger($this->sqlLogger);
    $response = $next($request, $response);
    return $response->withHeader("Content-Type", "application/json; charset=utf-8");
});

