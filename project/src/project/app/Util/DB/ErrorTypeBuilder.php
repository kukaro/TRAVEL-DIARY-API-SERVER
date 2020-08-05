<?php

namespace App\Util\DB;

use Illuminate\Database\QueryException;

class ErrorTypeBuilder
{
    static public function get(QueryException $e)
    {
        if($e->getPrevious()->errorInfo==null){
            return ErrorType::$STOP;
        }
        $error = $e->getPrevious()->errorInfo[1];
        $sql_state = $e->getPrevious()->errorInfo[0];
        switch ($error . ':' . $sql_state) {
            case '1062:23000':
                return ErrorType::$DUP;
            default:
                return ErrorType::$UND;
        }
    }
}
