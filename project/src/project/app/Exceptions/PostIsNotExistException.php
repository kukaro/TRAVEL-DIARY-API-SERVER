<?php


namespace App\Exceptions;


use App\Util\ExceptionMessage;
use Exception;

class PostIsNotExistException extends Exception
{

    private int $id;

    /**
     * PostIsNotExistException constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function render($request)
    {
        return response()->json(new ExceptionMessage(
            ["id" => $this->id],
            "signup fail"
        ), 401);
    }
}
