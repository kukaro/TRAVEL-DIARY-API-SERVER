<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['email', 'name', 'age', 'birth_date', 'password'];
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';

    public function picture()
    {
        return $this->hasMany('App\Model\Picture', 'owner_email', 'email');
    }
}
