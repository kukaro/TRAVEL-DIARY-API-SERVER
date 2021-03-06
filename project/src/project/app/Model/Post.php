<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = ['id', 'owner_id', 'title', 'contents', 'parents_post_id'];
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id', 'owner_id');
    }

    public function picture()
    {
        return $this->belongsToMany('App\Model\Post',
            'post_picture',
            'post_id',
            'picture_id');
    }
}
