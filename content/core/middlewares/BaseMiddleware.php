<?php

namespace content\core\middlewares;

/**
 *  Class BaseMiddleware
 *
 * @package content\core\middlewares
 */
abstract class BaseMiddleware
{
    abstract  public function execute();
}