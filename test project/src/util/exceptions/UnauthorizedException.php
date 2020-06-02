<?php


namespace util\exceptions;


class UnauthorizedException extends AbstractException
{

    public function getStatusCode()
    {
        return 401;
    }
}