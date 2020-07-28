<?php

namespace App\Http\Dto;

class Join
{
    private $origin_table_name;
    private $origin_on_name;
    private $target_table_name;
    private $target_on_name;

    public function __construct($origin_table_name, $origin_on_name,$target_table_name, $target_on_name)
    {
        $this->origin_table_name = $origin_table_name;
        $this->origin_on_name = $origin_on_name;
        $this->target_table_name = $target_table_name;
        $this->target_on_name = $target_on_name;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }
}
