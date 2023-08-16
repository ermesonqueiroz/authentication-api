<?php

namespace App\Exceptions;

use Exception;

class IncorrectLoginCredentials extends Exception
{
    public function render($request)
    {
        return response([ "error" => "Incorrect credentials"], 401);
    }
}
