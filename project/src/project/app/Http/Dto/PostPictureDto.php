<?php

namespace App\Http\Dto;

class PostPictureDto extends DtoImpl
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

    /**
     * Class constructor.
     * @param int $id
     * @param int $post_id
     * @param int $picture_id
     */
    public function __construct(int $id, int $post_id, int $picture_id)
    {
        $this->id = $id;
        $this->post_id = $post_id;
        $this->picture_id = $picture_id;
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
