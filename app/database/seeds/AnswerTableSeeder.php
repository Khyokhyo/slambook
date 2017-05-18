<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AnswerTableSeeder extends Seeder {

	public function run()
	{
		$answers = [
			[
				  'id' => 1,
				  'user_id'	=> 1,
				  'question_id'	=> 1,
				  'question_user_id' => 1,
				  'answers'	=> 'Huggsy',
				  'updated_at' => date('Y-m-d H:i:s'),
				  'created_at' => date('Y-m-d H:i:s')	
			],
		];

		DB::table('answers')->insert($answers);
	}

}