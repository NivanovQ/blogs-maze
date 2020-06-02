<?php

namespace util\exceptions;
/**
 * Created by PhpStorm.
 * User: Krasi_PC
 * Date: 9/10/2018
 * Time: 3:00 PM
 */
class AuthenticationException extends AbstractException {

    public  function getStatusCode() {
        return 401;
    }
}