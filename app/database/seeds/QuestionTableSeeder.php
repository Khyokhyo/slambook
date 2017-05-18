<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuestionTableSeeder extends Seeder {

	public function run()
	{
		$questions = [
			[
				  'id' => 1,
				  'user_id'	=> 1,
				  'questions' => 'Your Name',
				  'updated_at' => date('Y-m-d H:i:s'),
				  'created_at' => date('Y-m-d H:i:s')	
			],
		];

		DB::table('questions')->insert($questions);
	}

}