<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => '投稿のタイトル',
        'body' => "本文です。テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト",
        'tags' => 'Laravel'
    ];
});


