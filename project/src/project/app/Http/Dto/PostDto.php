<?php

namespace App\Http\Dto;

class PostDto implements Dto
{
    private int $id;
    private int $owner_id;
    private string $title;
    private string $contents;
    private ?int $parents_post_id;
    private string $created_date;
    private string $updated_date;


    /**
     * PostDto constructor.
     * @param int $id
     * @param int $owner_id
     * @param string $title
     * @param string $contents
     * @param int|null $parents_post_id
     * @param string $created_date
     * @param string $updated_date
     */
    public function __construct(
        int $id,
        int $owner_id,
        string $title,
        string $contents,
        ?int $parents_post_id,
        string $created_date,
        string $updated_date
    )
    {
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
