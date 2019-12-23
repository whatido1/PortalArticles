<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Article::class, function (Faker $faker) {
    $Categories = collect([1,2,3,4,5]);
    $title = $faker->unique()->sentence();
    return [
        "title" => $title,
        "slug" => Str::slug($title),
        "content" => $faker->text,
        "user_id" => 1,
        "category_id" => $Categories->random(),
    ];
});
