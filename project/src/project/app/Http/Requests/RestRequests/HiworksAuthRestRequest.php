<?php

namespace App\Http\Requests\RestRequests;

class HiworksAuthRestRequest extends RestRequest
{

    private ?int $user_no;
    private ?int $owner_id;
    private ?int $office_no;
    private ?string $user_id;
    private ?string $user_name;
    private ?string $access_token;
    private ?string $refresh_token;


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
                    "user_no" => "required",
                    "owner_id" => "required",
                    "office_no" => "required",
                    "user_id" => "required",
                    "user_name" => "required",
                ];
            default:
                return [

                ];
        }
    }

    public function messages()
    {
        return [
            "owner_id.required" => "required",
            "location.required" => "required",
            "path.required" => "required",
        ];
    }
}
