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

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'id', 'owner_id');
    }

    public function post()
    {
        return $this->belongsToMany('App\Model\Picture',
            'post_picture',
            'picture_id',
            'post_id');
    }
}
