<?php

use Illuminate\Support\Str;
use App\Province;
use App\Barangay;
use App\City;
use App\Person;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Person::class, function (Faker $faker) {
    return [
        'firstname'         => $faker->firstname,
        'middlename'        => $faker->firstname,
        'lastname'          => $faker->lastName,
        'suffix'            => $faker->suffix,
        'province_code'     => Province::first()->code,
        'city_code'         => City::first()->code,
        'temporary_address' => $faker->address,
        'address'           => $faker->address,
        'barangay_code'     => Barangay::first()->code,
        'age'               => $faker->numberBetween(1, 90),
        'civil_status'      => 'Single',
        'gender'            => $faker->randomElement(['female', 'male']),
        'phone_number'      => $faker->phoneNumber,
        'date_of_birth'     => Carbon::now(),
    ];
});
