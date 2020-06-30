<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'owner_email';
    public $incrementing = false;
    protected $fillable = ['id', 'owner_email', 'title', 'contents', 'parents_post_id'];
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}
