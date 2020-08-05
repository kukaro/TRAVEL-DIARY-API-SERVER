<?php


namespace App\Exceptions;

use App\Util\DB\ErrorType;
use Exception;

class DuplicateException extends Exception
{
    public function render($request)
    {
        return response(ErrorType::$DUP, 500);
    }
}
