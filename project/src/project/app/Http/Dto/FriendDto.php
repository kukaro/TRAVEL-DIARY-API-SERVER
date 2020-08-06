<?php

namespace App\Http\Dto;

class FriendDto implements Dto
{
    private int $id;
    private string $owner_id;
    private string $friend_id;

    /**
     * FriendDto constructor.
     * @param int $id
     * @param string $owner_id
     * @param string $friend_id
     */
    public function __construct(
        int $id,
        string $owner_id,
        string $friend_id
    )
    {
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->friend_id = $friend_id;
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
