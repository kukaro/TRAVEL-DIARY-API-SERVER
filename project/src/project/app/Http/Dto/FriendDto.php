<?php

namespace App\Http\Dto;

class FriendDto extends DtoImpl
{
    private int $id;
    private string $owner_email;
    private string $friend_email;

    /**
     * Class constructor.
     * @param $id
     * @param $owner_email
     * @param $friend_email
     */
    public function __construct(
        $id,
        $owner_email,
        $friend_email
    )
    {
        $this->id = $id;
        $this->owner_email = $owner_email;
        $this->friend_email = $friend_email;
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
