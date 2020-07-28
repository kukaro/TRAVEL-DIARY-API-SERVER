<?php

namespace App\Http\Requests\RestRequests;

class HiworksAuthRestRequest extends RestRequest
{

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
