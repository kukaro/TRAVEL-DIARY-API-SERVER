<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friend';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'owner_email', 'friend_email'];
    public $timestamps = false;
}
