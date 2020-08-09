<?php

namespace App\Http\Requests\RestRequests;

class PostCommentRestRequest extends RestRequest
{
    private ?int $id = null;
    private ?int $owner_id = null;
    private ?int $post_id = null;
    private ?string $contents = null;
    private ?int $parents_comment_id = null;
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
                    "owner_id" => "required",
                    "post_id" => "required",
                    "contents" => "required",
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
            "post_id.required" => "required",
            "contents.required" => "required",
        ];
    }
}
