<?php


namespace App\Util\DB;


class ErrorType implements \JsonSerializable
{
    public static ErrorType $DUP;
    public static ErrorType $STOP;
    public static ErrorType $LACK;
    public static ErrorType $REFUSE;
    public static ErrorType $LOGIN_FAIL;

    private string $message;
    private ?string $comment = null;

    public static function init()
    {
        ErrorType::$DUP = new ErrorType("duplicate");
        ErrorType::$STOP = new ErrorType("stop");
        ErrorType::$LACK = new ErrorType("lack");
        ErrorType::$REFUSE = new ErrorType("refuse");
        ErrorType::$LOGIN_FAIL = new ErrorType("login_fail");
    }

    /**
     * ErrorType constructor.
     * @param string $message
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * @param string $comment
     * @return ErrorType
     */
    public static function getUnd(string $comment)
    {
        $ret = new ErrorType("undefined");
        $ret->setComment($comment);
        return $ret;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        if (is_null($this->comment)) {
            return ["type" => $this->message];
        } else {
            return ["type" => $this->message, "comment" => $this->comment];
        }
    }
}
