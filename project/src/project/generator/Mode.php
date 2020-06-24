<?php

class Mode{
    static private $list = ['default'];
    private $data;

    public function __construct($data)
    {
        $this->setData($data);
    }

    public function setData(String $str){
        $ret = 'default';
        foreach(Mode::$list as $item){
            if($str ==$item){
                $ret = $str;
            }
        }
        $this->data =$ret;
    }
    public function getData(){
        return $this->data;
    }

    public function __toString(){
        return $this->data;
    }
}