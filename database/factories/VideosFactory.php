<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\Category;
use App\Video;
use Faker\Generator as Faker;
use Webpatser\Uuid\Uuid;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title' => $faker->text(17),
        'artist' => $faker->name,
        'producer' => $faker->name,
        'category_id' => Category::all()->random()->id,
        'cover_image' => 'seeder/'.random_int(1,4).'.jpg',
        'location' => 'seeder/vid.mp4',
        'extension' => 'mp4',
        'verified' => true, 
        'u_name' => Admin::all()->random()->name,
        'released_date' => $faker->dateTimeThisYear(now()),
        'market' => $faker->randomElement(['free', 'sale']),
        'amount' => 100,
        'downloads_count' => $faker->numberBetween(2, 1000),
        'uuid' => (string)Uuid::generate(4),
    ];
});
