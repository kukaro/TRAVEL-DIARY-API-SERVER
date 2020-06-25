<?php

namespace App\Http\Dto;

class Joins
{
    private $table_name;
    private $on_name;

    public function __construct($table_name, $on_name)
    {
        $this->table_name = $table_name;
        $this->on_name = $on_name;
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
