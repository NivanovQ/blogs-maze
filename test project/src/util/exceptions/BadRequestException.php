<?php
/**
 * Created by PhpStorm.
 * User: Krasi_PC
 * Date: 9/10/2018
 * Time: 11:32 PM
 */

namespace util\exceptions;


class BadRequestException extends AbstractException {

    public  function getStatusCode() {
        return 400;
    }
}