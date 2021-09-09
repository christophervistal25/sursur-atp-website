<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\CityScope;

class City extends Model
{
    public    $incrementing = false;
    protected $primaryKey   = 'code';
    protected $fillable     = ['name', 'status', 'province_code', 'code'];

     /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new CityScope);
    }


    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['province_code'];
    }

    public function province()
    {
        return $this->belongsTo('App\Province', 'province_code', 'code');
    }

    public function barangays()
    {
        return $this->hasMany('App\Barangay', 'city_code', 'code');
    }

    public function people()
    {
        return $this->hasMany('App\Person');
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\City
     * @return string
     */
    public static function laratablesCustomAction($city)
    {
        return view('admin.setting.includes.index', compact('city'))->render();
    }

    public static function laratablesCustomMunicipalityProvince($municipality)
    {
        return 
        "
        <div>
            <span class='font-medium'>{$municipality->province->name}</span>
        </div>
        ";
    }

    public static function laratablesCustomMunicipalityBarangay($municipality)
    {
        return 
        "
        <div class='text-center'>
            <span class='font-medium'>{$municipality->barangays->count()}</span>
        </div>
        ";
    }
}
