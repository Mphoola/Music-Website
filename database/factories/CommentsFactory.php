<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Beat;
use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'creator_name' => $faker->name,
        'creator_email' => $faker->safeEmail,
        'content' => $faker->paragraph,
        'commentable_id' => Beat::all()->random()->id,
        'commentable_type' => $faker->randomElement(['App\Beat', 'App\Song', 'App\Video', 'App\Post'])
    ];
});
