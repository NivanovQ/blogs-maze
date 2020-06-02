<?php
/**
 * Created by PhpStorm.
 * User: Krasi_PC
 * Date: 21.7.2017 г.
 * Time: 16:36
 */

namespace util;


use Monolog\Logger;

class LogUtil {

    /** @var  Logger */
    public static $log;
    /** @var  Logger */
    public static $sql;

    public static function registerLogger(Logger $logger) {
        self::$log = $logger;
    }

    public static function registerSQLLogger(Logger $logger) {
        self::$sql = $logger;
    }

}