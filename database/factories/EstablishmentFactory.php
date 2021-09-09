<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Establishment;
use Faker\Generator as Faker;
use App\Http\Controllers\Repositories\EstablishmentRepository;

$factory->define(Establishment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->randomElement(EstablishmentRepository::TYPES),
        'address' => $faker->address,
        'contact_no' => '09193693499',
        'geo_tag_location' => '',
        'province' => 'Suriga del Sur',
        'city_zip_code' => 8300,
        'barangay_id' => 1,
    ];
});
