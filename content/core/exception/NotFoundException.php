<?php

namespace content\core\exception;

use Exception as ExceptionAlias;

/**
 * Class ForbiddenException
 *
 * @var ExceptionAlias
 */
class NotFoundException extends ExceptionAlias
{

    protected $message = 'página no encontrada';
    protected $code = 404;
}