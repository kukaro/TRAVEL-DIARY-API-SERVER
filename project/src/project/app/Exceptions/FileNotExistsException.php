<?php


namespace App\Exceptions;

use App\Util\DB\ErrorType;
use App\Util\ExceptionMessage;
use Exception;

/**
 * 파일이 존재하지 않을 경우의 예외 처리입니다.
 * @package App\Exceptions
 */
class FileNotExistsException extends Exception
{
    private string $path;


    public function __construct(string $path)
    {
        parent::__construct();
        $this->path = $path;
    }

    public function render($request)
    {
        return response()->json(new ExceptionMessage(
            ["filename" => $this->path],
            "file is not exist"
        ), 404);
    }
}
