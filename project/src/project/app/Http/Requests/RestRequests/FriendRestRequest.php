<?php

namespace App\Http\Requests\RestRequests;

class FriendRestRequest extends RestRequest
{
    private ?int $id;
    private ?int $owner_id;
    private ?int $friend_id;

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
                    "owner_id" => "required",
                    "friend_id" => "required",
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
            "friend_id.required" => "required",
        ];
    }
}
