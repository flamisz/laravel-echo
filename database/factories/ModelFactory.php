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

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->text
    ];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title),
        'embed_code' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/lC-auAlsoUw" frameborder="0" allowfullscreen></iframe>'
    ];
});

$factory->define(App\PhotoCollection::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => str_slug($title)
    ];
});

$factory->define(App\Photo::class, function (Faker\Generator $faker) {
    $title = $faker->sentence;
    return [
        'photo_collection_id' => function () {
            return factory('App\PhotoCollection')->create()->id;
        },
        'title' => $title,
        'slug' => str_slug($title),
        'description' => $faker->text,
        'file_name' => '300.png'
    ];
});
