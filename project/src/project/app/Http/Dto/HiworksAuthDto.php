<?php

namespace App\Http\Dto;

class HiworksAuthDto implements Dto
{

    private $user_no;
    private $owner_id;
    private $office_no;
    private $user_id;
    private $user_name;
    private $access_token;
    private $refresh_token;

    /**
     * Class constructor.
     * @param $user_no
     * @param $owner_id
     * @param $office_no
     * @param $user_id
     * @param $user_name
     * @param $access_token
     * @param $refresh_token
     */
    public function __construct(
        $user_no,
        $owner_id,
        $office_no,
        $user_id,
        $user_name,
        $access_token,
        $refresh_token
    )
    {
        $this->user_no = $user_no;
        $this->owner_id = $owner_id;
        $this->office_no = $office_no;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->access_token = $access_token;
        $this->refresh_token = $refresh_token;
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
