<?php

namespace App\Http\Dto;

class HiworksAuthDto extends DtoImpl
{
<<<<<<< HEAD
    private $user_no;
    private $owner_email;
    private $office_no;
    private $user_id;
    private $user_name;

    /**
     * Class constructor.
     * @param $user_no
     * @param $owner_email
     * @param $office_no
     * @param $user_id
     * @param $user_name
     */
    public function __construct(
        $user_no,
        $owner_email,
        $office_no,
        $user_id,
        $user_name
    )
    {
        $this->user_no = $user_no;
        $this->owner_email = $owner_email;
        $this->office_no = $office_no;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
=======

    /**
     * Class constructor.
     */
    public function __construct()
    {
        
>>>>>>> 499388279af6a3a2256564b8bd3aef82b527cb8b
    }

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
