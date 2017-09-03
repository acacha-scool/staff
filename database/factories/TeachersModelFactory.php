<?php

/*
|--------------------------------------------------------------------------
| User Management Model Factories
|--------------------------------------------------------------------------
|
| Model factories for users management module
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Acacha\Scool\Staff\Models\Teacher::class, function (Faker\Generator $faker) {
    return [
        'code' => $id = $faker->unique()->numberBetween($min = 1, $max = 110),
        'state' => 'active',
        'speciality_id' => factory(Speciality::class)->create()->id,
        'type' => factory(Area::class)->create()->id,
        'position_id' => factory(JobPosition::class)->create()->id
    ];
});

///** @var \Illuminate\Database\Eloquent\Factory $factory */
//$factory->define(\Acacha\Users\Models\ProgressBatch::class, function (Faker\Generator $faker) {
//    return [
//        'accomplished' => $id = $faker->unique()->numberBetween($min = 1, $max = 10000),
//        'incidences' => $id = $faker->unique()->numberBetween($min = 1, $max = 10000),
//        'state' => $faker->randomElement(['pending','finished','stopped']),
//        'type' => 'App\User'
//    ];
//});
