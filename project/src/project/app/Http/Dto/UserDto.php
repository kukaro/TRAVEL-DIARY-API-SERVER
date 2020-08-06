<?php

namespace App\Http\Dto;

class UserDto implements Dto
{
    private int $id;
    private string $email;
    private string $name;
    private ?int $age;
    private ?string $birth_date;
    private string $password;
    private bool $is_hiworks;
    private string $created_date;
    private string $updated_date;

    /**
     * UserDto constructor.
     * @param int $id
     * @param string $email
     * @param string $name
     * @param int|null $age
     * @param string|null $birth_date
     * @param string $password
     * @param bool $is_hiworks
     * @param string $created_date
     * @param string $updated_date
     */
    public function __construct(
        int $id,
        string $email,
        string $name,
        ?int $age,
        ?string $birth_date,
        string $password,
        bool $is_hiworks,
        string $created_date,
        string $updated_date
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
