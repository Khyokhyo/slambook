<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class RequestTableSeeder extends Seeder {

	public function run()
	{
		$requests = [
			[
				  'id' => 1,
				  'sender_id'	=> 1,
				  'receiver_id' => 1,
				  'request_type' => 1,
				  'request_status' => 1,
				  'updated_at' => date('Y-m-d H:i:s'),
				  'created_at' => date('Y-m-d H:i:s')	
			],
		];

		DB::table('requests')->insert($requests);
	}

}