<?php

namespace util\exceptions;




abstract class AbstractException extends \Exception {

    public abstract function getStatusCode();

    public function __construct($message = "") {
        parent::__construct($message);
    }
}