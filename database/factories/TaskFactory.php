<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'days' => $faker->numberBetween($min = 0, $max = 30),
        'hours' => $faker->numberBetween($min = 0, $max = 23),
        'minutes' => $faker->numberBetween($min = 0, $max = 59),
        'seconds' => $faker->numberBetween($min = 0, $max = 59),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2)
    ];
});
