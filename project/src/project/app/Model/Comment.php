<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'owner_id', 'contents', 'parents_contents_id'];
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}
