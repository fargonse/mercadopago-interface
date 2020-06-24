<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AppToken;
use Faker\Generator as Faker;

$factory->define(AppToken::class, function (Faker $faker) {
    return [
        'client_id' => rand(1,3),
        'mode' => 'local',
        'keys' => '{"public_key":"FACTORY-DEFAULT-KEY", "access_token":"FACTORY-DEFAULT-TOKEN"}',
    ];
});
