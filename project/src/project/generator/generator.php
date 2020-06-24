<?php

include_once './autoload.php';

echo "WELCOME GENERATOR!\n";

/**
 * 최소한 mode, type, name을 추가해야함
 * 4로 하는 이유는 위의 3가지 플러스 실행명 때문임
 */
if (count($argv) != 4) {
    echo "Arguments must insert 3 items.\nEXAMPLE : generator.php default api User\n";
    exit;
}
$mode = new Mode($argv[1]);
$type = new Type($argv[2]);
$name = $argv[3];
$name[0] = strtoupper($name[0]);
$DEBUG = false;
echo "Mode:$mode, Type:$type, Name:$name\n";

/**
 * 구분자 현재는 한개를 쓰지만 나중에 추가할 수 있고 구조화 될 수 있음.
 */
$sep = "<0>";
$seps = [];
array_push($seps, $sep);

use Config\ApiConfig;
/**
 * 아직 전역 변수를 사용하고 있음
 * 나중에 구조화 필요함
 */
function filewrite($seps, $file_data)
{
    global $name;
    $template_name = $file_data["template_path"];
    $tp = fopen($template_name, "r");
    $content = fread($tp, filesize($template_name));
    $file_name = $file_data["name"];
    foreach ($seps as $sep) {
        $content = str_replace($sep, $name, $content);
        $file_name = str_replace($sep, $name, $file_name);
    }
    echo $file_data["path"] . "/" . $file_name;
    $fp =  fopen($file_data["path"] . "/" . $file_name, "w");
    fwrite($fp, $content);
    fclose($tp);
    fclose($fp);
}

if(!DEBUG){
    foreach(array_keys(ApiConfig::$data) as $atom){
        filewrite($seps, atom);
    }
}

// filewrite($seps, ApiConfig::$data["Controller"]);
