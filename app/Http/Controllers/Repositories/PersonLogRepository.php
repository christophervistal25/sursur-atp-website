<?php

namespace App\Http\Controllers\Repositories;

use App\PersonLog;

class PersonLogRepository
{
    public static function getLogsByTemperatureRange(float $min, float $max, string $cityCode = null)
    {
        if(is_null($cityCode)) {
            return PersonLog::where('body_temperature', '>=', $min)
                        ->where('body_temperature', '<=', $max)
                        ->count();
        } else {
            return PersonLog::with(['person' => function ($query) use ($cityCode) {
                $query->where('city_code', $cityCode);
            }])
            ->where('body_temperature', '>=', $min)
            ->where('body_temperature', '<=', $max)
            ->count();
        }
    }
}

