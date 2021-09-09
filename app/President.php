<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class President extends Authenticatable
{
	use Notifiable;
    protected $fillable = ['email', 'name', 'address',  'profile'];

    protected $hidden = [
    	'password'
    ];
}
