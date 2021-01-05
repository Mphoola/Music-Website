<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'content' => $faker->paragraph(random_int(3, 9)),
        'published_at' => $faker->dateTimeThisYear,
        'image' => 'seeder/'.random_int(1,4).'.jpg',
        'slug' => $faker->slug(),
        'views' => $faker->numberBetween(12, 99),
        'author_id' => Admin::all()->random()->id
    ];
});
