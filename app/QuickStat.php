<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickStat extends Model
{
    protected $fillable = [
        'name',
        'confirmed',
        'recovered',
        'deaths',
    ];
}
