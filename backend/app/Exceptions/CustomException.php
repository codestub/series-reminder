<?php

namespace App\Exceptions;

class CustomException extends \Exception
{
    public $message;
    public $code;

    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }

    // public function render()
    // {
    //     return response()->json(['error' => $this->message], $this->code);
    // }
}