<?php

namespace App\Http\Requests\RestRequests;

class PostPictureRestRequest extends RestRequest
{
    private ?int $id;
    private ?int $post_id;
    private ?int $picture_id;

    public function __construct(){}

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
                    "post_id" => "required",
                    "picture_id" => "required",
                ];
            default:
                return [

                ];
        }
    }

    public function messages()
    {
        return [
            "post_id.required" => "required",
            "picture_id.required" => "required",
        ];
    }
}
