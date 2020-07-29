<?php

namespace App\Http\Requests\RestRequests;

class HiworksAuthRestRequest extends RestRequest
{
<<<<<<< HEAD
    private $user_no;
    private $owner_email;
    private $office_no;
    private $user_id;
    private $user_name;
=======
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b

    /**
     * Class constructor.
     */
    public function __construct()
    {
    }
<<<<<<< HEAD

=======
    
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b
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
