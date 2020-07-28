<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostPicture extends Model
{
    protected $table = 'post_picture';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id', 'post_id', 'picture_id'];
    public $timestamps = false;
}
