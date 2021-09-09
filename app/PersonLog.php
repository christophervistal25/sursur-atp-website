<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PersonLog extends Model
{
    public const LOW_NORMAL = 30.5;
    public const HIGH_NORMAL = 37.5;

    public const LOW_FEVER = 37.6;
    public const HIGH_FEVER = 38.0;


    public const LOW_SEVERE = 38.1;
    public const HIGH_SEVERE = 43.0;

    protected $fillable = ['person_id', 'location', 'checker_id','purpose', 'body_temperature', 'time'];

    public function getColorForTemperatureAttribute()
    {
        if( $this->body_temperature >= self::LOW_NORMAL && $this->body_temperature <= self::HIGH_NORMAL) {
            // Normal
            return "bg-theme-9";
        } else if($this->body_temperature <= self::LOW_NORMAL) {
            // Normal
            return "bg-theme-9";
        } else if($this->body_temperature >= self::LOW_FEVER  && $this->body_temperature <= self::HIGH_FEVER) {
            // Fever
            return "bg-theme-12";
        } else if($this->body_temperature >= self::LOW_SEVERE && $this->body_temperature <= self::HIGH_SEVERE) {
            // Severe
            return "bg-theme-6";
        } else if ($this->body_temperature >= self::HIGH_SEVERE) {
            // Severe
            return "bg-theme-6";
        }
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function checker()
    {
        return $this->belongsTo('App\Checker');
    }

    public function getTimeAttribute($value)
    {
        list($date, $month, $year, $hours, $minutes, $greet) = explode('-', str_replace(' ', '-', $value));
        $date = $month .'/'. $date . '/' . $year . ' ' . $hours . ':' . $minutes . ' ' . $greet;
        return Carbon::parse($date)->format(' F d, Y h:i A');
        // return Carbon::parse($date)->format('m/d/Y');
    }
}
