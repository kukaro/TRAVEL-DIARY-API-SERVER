<?php

namespace App\Http\Dto;

class UserDto implements Dto
{
    private $id;
    private $email;
    private $name;
    private $age;
    private $birth_date;
    private $password;
    private $is_hiworks;
    private $created_date;
    private $updated_date;

    /**
     * Class constructor.
     */
    public function __construct(
        $id,
        $email,
        $name,
        $age,
        $birth_date,
        $password,
        $is_hiworks,
        $created_date,
        $updated_date
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->age = $age;
        $this->birth_date = $birth_date;
        $this->password = $password;
        $this->is_hiworks = $is_hiworks;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
