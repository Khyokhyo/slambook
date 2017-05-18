<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UserDetailsTableSeeder extends Seeder {

	public function run()
	{
		$user_details = [
			[
				  'user_id' => 1,
				  'date_of_birth' => date('Y-m-d'),
				  'city'	=> 'Sylhet',
				  'school' => 'MGCC',
				  'college' => 'MGCC',
				  'university' => 'SUST',
				  'updated_at' => date('Y-m-d H:i:s'),
				  'created_at' => date('Y-m-d H:i:s')	
			],
		];

		DB::table('user_details')->insert($user_details);	
	
	}

}