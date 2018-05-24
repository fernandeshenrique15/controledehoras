<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration {
	public function up() {
		Schema::create('works', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->string('lastname', 50);
			$table->integer('idDepartment')->unsigned();
			$table->foreign('idDepartment')->references('id')->on('departments');
			$table->string('email', 50);
			$table->integer('hours');
			$table->integer('minutes');
		});
	}

	public function down() {
		Schema::dropIfExists('works');
	}
}
