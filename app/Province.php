<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ProvinceScope;

class Province extends Model
{
    public $incrementing = false;
    public    $primaryKey = 'code';
    protected $fillable   = ['code', 'name', 'income_classification', 'population'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ProvinceScope);
    }

    public function cities()
    {
        return $this->hasMany('App\City', 'province_code', 'code');
    }

    public function barangay()
    {
        return $this->hasMany('App\Barangay', 'province_code', 'code');
    }


    public static function laratablesCustomProvinceCities($province)
    {
        return 
        "
        <div class='text-center'>
            <span class='font-medium'>{$province->cities->count()}</span>
        </div>
        ";
    }

    public static function laratablesCustomProvinceBarangay($province)
    {
        return 
        "
        <div class='text-center'>
            <span class='font-medium'>{$province->barangay->count()}</span>
        </div>
        ";
    }

}
