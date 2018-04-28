<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		User::create([
			'name'           => 'admin',
			'email'          => 'admin@localhost',
			'password'       => bcrypt('secret'),
			'remember_token' => str_random(10),
		]);
		factory(App\User::class, 3)->create();
	}
}
