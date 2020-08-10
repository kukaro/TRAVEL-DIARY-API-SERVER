<?php

namespace App\Http\Requests\RestRequests;

class UserRestRequest extends RestRequest
{
    private ?int $id = null;
    private ?string $email = null;
    private ?string $name = null;
    private ?int $age = null;
    private ?string $birth_date = null;
    private ?bool $is_hiworks = false;
    private ?string $password = "0";
    private ?string $created_date = null;
    private ?string $updated_date = null;

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
        switch ($this->req_method) {
            case "POST":
                return [
                    "email" => "required",
                    "name" => "required",
                    "password" => "required",
                ];
            default:
                return [

                ];
        }
    }

    public function messages()
    {
        return [
            "email.required" => "required",
            "name.required" => "required",
            "password.required" => "required",
        ];
    }
}
