<?php

namespace App\Http\Dto;

class FriendDto implements Dto
{
    private int $id;
    private string $owner_id;
    private string $friend_id;

    /**
     * Class constructor.
     * @param $id
     * @param $owner_id
     * @param $friend_id
     */
    public function __construct(
        $id,
        $owner_id,
        $friend_id
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
