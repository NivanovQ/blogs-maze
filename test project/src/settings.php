<?php
return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../Templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'erp_logger',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'sqlLogger' => [
            'name' => 'sqlLogger',
            'path' => __DIR__ . '/../logs/sql.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
//        //db connection for localhost
        'db' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'project',
            'username' => 'root',
            'password' => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ],
];
