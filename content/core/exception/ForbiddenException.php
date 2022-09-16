<?php

namespace content\core\exception;

use Exception;

/**
 * Class ForbiddenException
 *
 * @var Exception
 */
class ForbiddenException extends Exception
{
    protected $message = 'No tiene permiso para acceder a esta pagina';
    protected $code = 403;
}