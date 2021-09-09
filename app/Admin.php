<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'profile', 'firstname', 'middlename', 'lastname', 'suffix', 'phone_number'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = Str::upper($value);
    }

    public function setMiddlenameAttribute($value)
    {
        $this->attributes['middlename'] = Str::upper($value);
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = Str::upper($value);
    }

    public function setSuffixAttribute($value)
    {
        $this->attributes['suffix'] = Str::upper($value);
    }
}
