<?php


namespace App\Exceptions;

use App\Util\ExceptionMessage;
use Exception;

/**
 * 회원가입이 실패했을 경우의 예외 처리입니다.
 * 메세지는 401을 반환합니다.
 * @package App\Exception
 */
class SignupFailException extends Exception
{
    private ?string $email;

    /**
     * LoginFailException constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        parent::__construct();
        $this->email = $email;
    }

    public function render($request)
    {
        return response()->json(new ExceptionMessage(
            ["email" => $this->email],
            "signup fail"
        ), 401);
    }
}
