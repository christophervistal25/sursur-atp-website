<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Municipal extends Authenticatable
{
	use Notifiable;

    protected $fillable = ['username', 'password', 'city_code', 'phone_number'];

    protected $hidden = [
    	'password'
    ];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function barangays()
    {
        return $this->hasMany('App\Barangay', 'city_code', 'city_code');
    }

    public function requests()
    {
        return $this->hasMany('App\UpdateUserRequest', 'request_id', 'city_code');
    }
}
