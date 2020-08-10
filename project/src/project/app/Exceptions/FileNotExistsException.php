<?php


namespace App\Exceptions;

use App\Util\DB\ErrorType;
use App\Util\ExceptionMessage;
use Exception;

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
