<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$users = [
			[
				  'username' => 'khyo',
				  'email' => 'khyo@test.com',
				  'password'	=> Hash::make('a'),
				  'updated_at' => date('Y-m-d H:i:s'),
				  'created_at' => date('Y-m-d H:i:s')	
			],
		];

		DB::table('users')->insert($users);	
	}

}