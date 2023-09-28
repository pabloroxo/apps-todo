<?php

namespace App\Exceptions;

use Exception;

class ArrayException extends Exception
{
    private $messages;

    public function __construct($message, $code = 0, $messages = []) 
    {
        parent::__construct($message, $code);

        $this->messages = $messages; 
    }

    public function getMessages()
    {
        return $this->messages;
    }
}
