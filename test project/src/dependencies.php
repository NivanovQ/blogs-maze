<?php
// DIC configuration

use util\LogUtil;

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $stream_handler = new Monolog\Handler\StreamHandler($settings['path'], $settings['level']);
    $stream_handler->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true));
    $logger->pushHandler($stream_handler);
    return $logger;
};

// monolog
$container['sqlLogger'] = function ($c) {
    $settings = $c->get('settings')['sqlLogger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $stream_handler = new Monolog\Handler\StreamHandler($settings['path'], $settings['level']);
    $stream_handler->setFormatter(new \Monolog\Formatter\LineFormatter(null, null, true));
    $logger->pushHandler($stream_handler);
    return $logger;
};

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

$container['errorHandler'] = function ($c) {
    return function (\Slim\Http\Request $request, \Slim\Http\Response $response, $exception) use ($c) {
        $status = $exception instanceof \util\exceptions\AbstractException ? $exception->getStatusCode() : 500;
        $error_obj = new \stdClass;
        $error_obj->method = $request->getMethod();
        $error_obj->url = $request->getUri()->getPath();
        $error_obj->has_error = true;
        $error_obj->status = $status;
        $error_obj->message = $exception->getMessage();
        return $response->withStatus($status)
            ->withHeader('Content-Type', 'application/json')
            ->write(json_encode($error_obj, JSON_UNESCAPED_SLASHES));
    };
};


