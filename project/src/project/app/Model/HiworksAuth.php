<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class HiworksAuth extends Model
{
    protected $table = 'hiworksauth';
    protected $primaryKey = 'user_no';
    public $incrementing = false;
    protected $fillable = ['user_no', 'owner_email', 'office_no', 'user_id', 'user_name', 'access_token', 'refresh_token'];
    public $timestamps = false;
}
