<?php

namespace App\Util\DB;

use Illuminate\Database\QueryException;

class ErrorTypeBuilder
{
    static public function get(QueryException $e)
    {
<<<<<<< HEAD
        dump($e->getCode());
=======
>>>>>>> aecac00919e0d5b2d265a1eb17398c0f5ad3d0a2
        if (is_null($e->getPrevious()->errorInfo)) {
            switch ($e->getCode()){
                case 1002:
                    return ErrorType::$REFUSE;
                case 1045:
                    return ErrorType::$LOGIN_FAIL;
            }
        }
        $error = $e->getPrevious()->errorInfo[1];
        $sql_state = $e->getPrevious()->errorInfo[0];
        switch ($error . ':' . $sql_state) {
            case '1062:23000':
                return ErrorType::$DUP;
            case '1048:23000':
                return ErrorType::$LACK;
            default:
                return ErrorType::getUnd($e->getPrevious()->errorInfo[2]);
        }
    }
}
