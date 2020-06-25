<?php

namespace App\Http\Dto;

class PictureDto implements Dto
{
    private $id;
    private $owner_email;
    private $location;
    private $path;
    private $created_date;
    private $updated_date;

    /**
     * Class constructor.
     */
    public function __construct($id, $owner_email, $location, $path, $created_date, $updated_date)
    {
        $this->id = $id;
        $this->owner_email = $owner_email;
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
