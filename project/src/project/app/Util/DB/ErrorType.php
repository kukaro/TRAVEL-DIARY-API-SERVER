<?php


namespace App\Util\DB;


class ErrorType implements \JsonSerializable
{
    public static ErrorType $DUP;
    public static ErrorType $UND;
    public static ErrorType $STOP;

    private string $message;

    public static function init()
    {
        ErrorType::$DUP = new ErrorType("duplicate");
        ErrorType::$UND = new ErrorType("undefined");
        ErrorType::$STOP = new ErrorType("stop");
    }

    private function __construct(string $message)
    {
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return ["type" => $this->message];
    }
}
