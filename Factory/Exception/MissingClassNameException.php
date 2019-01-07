<?php

namespace GolemAi\Core\Factory\Exception;

use Throwable;

class MissingClassNameException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        if ('' === $message) {
            $message = 'Missing mandatory "class" argument.';
        }
        parent::__construct($message, $code, $previous);
    }
}