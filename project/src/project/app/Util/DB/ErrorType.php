<?php

namespace App\Util\DB;

class ErrorType implements \JsonSerializable
{
    private string $error_type;
    private int $error;
    private int $sql_state;
    private int $status;

    public function __construct(int $error, int $sql_state)
    {
        $this->sql_state = $sql_state;
        $this->error = $error;
        switch ($error . ':' . $sql_state) {
            case '1062:23000':
                $this->error_type =  Type::$DUP;
                $this->status = 500;
                break;
            default:
                $this->error_type =  Type::$UND;
                $this->status = 500;
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
