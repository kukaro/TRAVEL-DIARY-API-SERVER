<?php

namespace App\Http\Dto;

class HiworksAuthDto implements Dto
{

    private int $user_no;
    private int $owner_id;
    private int $office_no;
    private string $user_id;
    private string $user_name;
    private string $access_token;
    private string $refresh_token;

    /**
     * HiworksAuthDto constructor.
     * @param int $user_no
     * @param int $owner_id
     * @param int $office_no
     * @param string $user_id
     * @param string $user_name
     * @param string $access_token
     * @param string $refresh_token
     */
    public function __construct(
        int $user_no,
        int $owner_id,
        int $office_no,
        string $user_id,
        string $user_name,
        string $access_token,
        string $refresh_token
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
