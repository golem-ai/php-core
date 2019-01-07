<?php

namespace GolemAi\Core\Factory\Exception;

class MissingArgumentException extends \Exception
{
    protected $message = "Missing argument %s";
    public function __construct($argumentName, $code = 0, \Throwable $previous = null)
    {
        parent::__construct(
            sprintf($this->message, $argumentName),
            $code,
            $previous
        );
    }
}