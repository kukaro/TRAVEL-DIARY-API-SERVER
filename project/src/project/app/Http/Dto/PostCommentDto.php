<?php

namespace App\Http\Dto;

class PostCommentDto implements Dto
{
    private $id;
    private $owner_id;
    private $post_id;
    private $contents;
    private $parents_comment_id;
    private $created_date;
    private $updated_date;

    /**
     * Class constructor.
     */
    public function __construct(
        $id,
        $owner_id,
        $post_id,
        $contents,
        $parents_comment_id,
        $created_date,
        $updated_date
    )
    {
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->post_id = $post_id;
        $this->contents = $contents;
        $this->parents_comment_id = $parents_comment_id;
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
