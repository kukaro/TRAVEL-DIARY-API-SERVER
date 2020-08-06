<?php

namespace App\Http\Dto;

class PostCommentDto implements Dto
{
    private int $id;
    private int $owner_id;
    private int $post_id;
    private string $contents;
    private ?int $parents_comment_id;
    private string $created_date;
    private string $updated_date;

    /**
     * PostCommentDto constructor.
     * @param int $id
     * @param int $owner_id
     * @param int $post_id
     * @param string $contents
     * @param int|null $parents_comment_id
     * @param string $created_date
     * @param string $updated_date
     */
    public function __construct(
        int $id,
        int $owner_id,
        int $post_id,
        string $contents,
        ?int $parents_comment_id,
        string $created_date,
        string $updated_date
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
