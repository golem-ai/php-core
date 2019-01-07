<?php

namespace GolemAi\Core\Factory\Exception;

class MissingClassNameException extends \Exception
{
    protected $message = 'Missing mandatory "class" argument.';
}