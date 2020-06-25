<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'owner_email', 'location', 'path'];
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}
