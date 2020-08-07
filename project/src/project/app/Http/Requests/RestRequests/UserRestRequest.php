<?php

namespace App\Http\Requests\RestRequests;

class UserRestRequest extends RestRequest
{
    private int $id;
    private string $email;
    private string $name;
    private ?int $age = null;
    private ?string $birth_date = null;
    private bool $is_hiworks;
    private string $password;
    private string $created_date;
    private string $updated_date;

    /**
     * Class constructor.
     */
    public function __construct()
    {
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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function rules()
    {
        return [

        ];
    }
}
