<?php

namespace App\Http\Requests\RestRequests;

class HiworksAuthRestRequest extends RestRequest
{
    private $user_no;
    private $owner_email;
    private $office_no;
    private $user_id;
    private $user_name;

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
}
