<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('sender_id')->unsigned();
			$table->foreign('sender_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->integer('receiver_id')->unsigned();
			$table->foreign('receiver_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
			$table->integer('request_type');
			$table->integer('request_status');
			$table->timestamps();

		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('requests');
	}

}
