<?php

namespace App\Http\Requests\RestRequests;

class PostPictureRestRequest extends RestRequest
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $post_id;
    /**
     * @var int
     */
    private $picture_id;

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
}
