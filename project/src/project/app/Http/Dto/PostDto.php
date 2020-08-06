<?php

namespace App\Http\Dto;

class PostDto implements Dto
{
    private $id;
    private $owner_id;
    private $title;
    private $contents;
    private $parents_post_id;
    private $created_date;
    private $updated_date;

    /**
     * Class constructor.
     */
    public function __construct(
        $id,
        $owner_id,
        $title,
        $contents,
        $parents_post_id,
        $created_date,
        $updated_date
    ) {
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->title = $title;
        $this->contents = $contents;
        $this->parents_post_id = $parents_post_id;
        $this->created_date = $created_date;
        $this->updated_date = $updated_date;
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
