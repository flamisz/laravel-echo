<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->state(App\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'is_admin' => true
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text(1000)
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'article_id' => function () {
            return factory('App\Article')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});