<?php

namespace App\Util;

class Name
{
    static function kebabToPascal($str){
        $ret="";
        $arr = str_split($str);
        $check = false;
        foreach($arr as $ch){
            if (!$check){
                $ret .= strtoupper($ch);
                $check = true;
            }else if($ch==='-'){
                $check = false;
            }else{
                $ret .= $ch;
            }
        }
        return $ret;
    }
}
