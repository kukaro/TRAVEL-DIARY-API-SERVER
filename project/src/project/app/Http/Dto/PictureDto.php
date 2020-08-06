<?php

namespace App\Http\Dto;

class PictureDto implements Dto
{
    private int $id;
    private int $owner_id;
    private string $location;
    private string $path;
    private string $created_date;
    private string $updated_date;

    /**
     * PictureDto constructor.
     * @param int $id
     * @param int $owner_id
     * @param string $location
     * @param string $path
     * @param string $created_date
     * @param string $updated_date
     */
    public function __construct(
        int $id,
        int $owner_id,
        string $location,
        string $path,
        string $created_date,
        string $updated_date
    )
    {
        $this->id = $id;
        $this->owner_id = $owner_id;
        $this->location = $location;
        $this->path = $path;
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
