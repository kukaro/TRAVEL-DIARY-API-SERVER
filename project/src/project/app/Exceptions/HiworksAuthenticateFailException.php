<?php


namespace App\Exceptions;


use App\Util\ExceptionMessage;
use Exception;

class HiworksAuthenticateFailException extends Exception
{

    /**
     * HiworksAuthenticateFailException constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function render($request)
    {
        return response()->json(new ExceptionMessage(
            [],
            "hiworks authenticate fail"
        ), 401);
    }
}
