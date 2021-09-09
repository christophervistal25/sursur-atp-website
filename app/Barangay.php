<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\BarangayScope;

class Barangay extends Model
{
    
    public    $incrementing = false;
    protected $primaryKey   = 'code';
    protected $fillable = ['name', 'code', 'status'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new BarangayScope);
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function people()
    {
        return $this->hasMany('App\Person');
    }

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = ucfirst(strtolower($value));
    // }
}
