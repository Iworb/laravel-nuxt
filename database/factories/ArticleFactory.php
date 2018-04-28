<?php

use App\User as User;
use Faker\Generator as Faker;

$factory->define(App\Article::class, function(Faker $faker) {
	$userIds = User::all()->pluck('id')->toArray();
	$locales = config('translatable.locales');
	$article = [];
	foreach ($locales as $locale) {
		$article[ 'user_id:' . $locale ]     = $faker->randomElement($userIds);
		$article[ 'title:' . $locale ]       = substr($faker->sentence(2), 0, - 1);
		$article[ 'description:' . $locale ] = $faker->paragraph;
		$article[ 'body:' . $locale ]        = $faker->paragraph;
	}

	return $article;
});
