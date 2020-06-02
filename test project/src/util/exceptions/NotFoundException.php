<?php


namespace util\exceptions;


class NotFoundException extends AbstractException {

    public  function getStatusCode() {
        return 404;
    }
}