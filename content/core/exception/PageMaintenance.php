<?php

namespace content\core\exception;

use Exception as ExceptionAlias;

class PageMaintenance extends ExceptionAlias
{
    protected $message = 'página en mantenimiento o desarrollo';
    protected $code = 403;
}