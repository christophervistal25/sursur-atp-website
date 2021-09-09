<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checker extends Model
{
    protected $fillable = ['username','firstname','middlename','lastname', 'suffix', 'password', 'municipal_code', 'phone_number'];

    protected $hidden = [
    	'password'
    ];


    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstname'] = strtoupper($value);
    }

    public function setMiddleNameAttribute($value)
    {
        $this->attributes['middlename'] = strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['lastname'] = strtoupper($value);
    }

    public function setSuffixAttribute($value)
    {
        $this->attributes['suffix'] = strtoupper($value);
    }


    public function city()
    {
        return $this->belongsTo('App\City', 'municipal_code', 'code');
    }

    public function logs()
    {
        return $this->hasMany('App\PersonLog');
    }

}
