<?php


namespace App\Exceptions;


use App\Util\ExceptionMessage;
use Exception;

/**
 * 토큰데이터를 받지 못했을 때 일어나는 예외입니다.
 * @package App\Exception
 */
class TokenRequestIsInvalidRequest extends Exception
{

    /**
     * TokeRequestIsInvalidRequest constructor.
     */
    public function __construct()
    {

    }

    public function render($request)
    {
        return response()->json(new ExceptionMessage(
            [],
            "token request is invalid"
        ), 404);
    }
}
